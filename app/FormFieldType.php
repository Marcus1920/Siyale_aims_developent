<?php namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache as Cache;
use Symfony\Component\DomCrawler\Crawler;

	class FormFieldType {
		public static $_inst = null;
		var $type = "a";
		
		function __construct($type = "") {
			//echo "<br>FormFieldType()";
			if ($type) $this->$type = $type;
		}
		
		static function Currency() {
			if (self::$_inst == null) self::$_inst = new FormFieldType("currency");
			$txtDebug = "FormFieldType::Currency()";
			$currencies = [];
			//Cache::forget("aims.Currencies");
			if (Cache::has("aims.Currencies")) {
				$currencies = json_decode( Cache::get("aims.Currencies"), true );
			} else {
				$currencies_tmp = [];
				$ch = curl_init();
				if (in_array($_SERVER['HTTP_HOST'], array("127.0.0.1", "localhost.net"))) curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/mirrors/Wikipedia/en.wikipedia.org/wiki/Currency.html");
				else curl_setopt($ch, CURLOPT_URL, "https://en.wikipedia.org/wiki/Currency");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				$grabbed = curl_exec($ch);
				if (strlen($grabbed) == 0) $txtDebug .= "\n  Think there was an error: ".curl_error($ch);
				curl_close($ch);
				$txtDebug .= "\n  Grabbed content: ".number_format(strlen($grabbed))." bytes";
				if (strlen($grabbed) == 0) die("<pre>$txtDebug<pre>");
				$crawler = new Crawler($grabbed);
				foreach ($crawler as $domElement) {
			    var_dump($domElement->nodeName);
				}
				$tables = $crawler->filter("table");
				foreach ($tables as $table) {
			    $html = $table->ownerDocument->saveHTML($table);
			    if (stristr($html, "Most traded currencies by value")) {
		    		$crawler = new Crawler($html);
		    		$rows = $crawler->filter("tr");
		    		for ($irow = 0; $irow < count($rows); $irow++) {
		    			$row = $rows->eq($irow);
							$kids = $row->children();
							$currency_tmp = [];
							if (count($kids->filter("td")) > 0) foreach ($kids AS $di=>$d) {
								if ($d->childNodes->length > 2) $currency_tmp[] = $d->childNodes->item($d->childNodes->length-2)->nodeValue;
							}
							$currencies_tmp[] = $currency_tmp;
		    		}
			    }
				}
				
				foreach ($currencies_tmp AS $c) if (count($c) > 0) {
					$currency = ['rank'=>$c[0], 'name'=>"", 'iso'=>"", 'symbol'=>""];
					$currency['name'] = ucwords(strtolower($c[1]));
					$currency['iso'] = explode(" ",$c[2])[0];
					$htmlsymbols = ['CNY'=>"&yen;",'EUR'=>"&euro;", 'INR'=>"&#8360;", 'JPY'=>"&yen;", 'KRW'=>"&#8361;", 'TRY'=>"&#8356;"];
//					$htmlsymbols = [];

					if (!array_key_exists($currency['iso'], $htmlsymbols)) {
					$currency['symbol'] = explode(" ",$c[2])[1];
					$currency['symbol'] = trim($currency['symbol'], " ()");
					$currency['symbol'] = utf8_decode($currency['symbol']);
					} else $currency['symbol'] = $htmlsymbols[$currency['iso']];
					//$txtDebug .= "\n  htmlspecialchars({$currency['symbol']}), {$currency['name']} - ".htmlspecialchars($currency['symbol']);
					$currencies[] = $currency;
				}
				Cache::put("aims.Currencies", json_encode($currencies), Carbon::now()->addMonths(1));
			}
			usort($currencies, "self::sortCurrencies");
			$txtDebug .= "\n  \$currencies: ".print_r($currencies, 1)."";
			//$txtDebug .= "\n  \$_SERVER - ".print_r($_SERVER,1);
			//die("<pre>$txtDebug<pre>");
			return $currencies;
		}
		
		public static function sortCurrencies($a, $b) {
			$factor = "name";
			//echo "<br>sortCurrencies(\$a, \$b) \$a[{$factor}] - {$a[$factor]}, \$b[{$factor}] - {$b[$factor]}";
			if ($a['iso'] == "ZAR" || $b['iso'] == "ZAR") return -1;
			else return strcmp($a[$factor], $b[$factor]);
		}
	}
?>