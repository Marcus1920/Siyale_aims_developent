<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB as DB;
use App\Http\Controllers\DatabaseController AS DbController;
use App\FormField;

class FormsData extends Eloquent {
	protected $table    = 'forms_data';
	protected $fillable = ['id','form_id','data'];
	
	public function __construct($attr = array()) {
		$txtDebug = "FormsData(\$attr = array()) \$attr - ".print_r($attr,1);
		parent::__construct($attr);
		//die("<pre>{$txtDebug}</pre>");
	}
	
	public function getTitleAttribute($title) {
		//return "WtF!?";
		//die("getTitleAttribute(\$title) \$title - {$title}");
		return $title;
  }
	
	public static function query() {
		//die();
		return parent::query();
	}
	
	public function save(array $opts = array('table'=>"")) {
		$txtDebug = "FormsData->save(\$opts) \$opts - ".print_r($opts, 1);
		//$txtDebug .= ", \$this - ".print_r($this, 1);
		$attr = $this->attributesToArray();
		$data = json_decode($attr['data'], true);
		///$txtDebug .= ", \$data A - ".print_r($data, 1);
		//$data = array_map("json_decode", $data);
		$data = array_map(function($inp) {
			$from_json = json_decode($inp, true);
			return $from_json ? $from_json : $inp;
		}, $data);
		///$txtDebug .= ", \$data B - ".var_export($data, 1)."\n";
		$form = Form::where("id", $attr['form_id'])->first()->toArray();
		/*foreach ($data AS $di=>$d) {
			echo "<br>Decoding {$di}";
			$data[$di] = json_decode($data[$di]);
		}*/
		//$note = json_decode($data['note']);
		$fields = FormField::where("form_id", $attr['form_id'])->get()->toArray();
		//usort($fields, function($a,$b) { return version_compare($a['order'], $b['order']); });
		usort($fields, function($a,$b) { return version_compare($a['order'], $b['order']); });
		$fieldss = array();
		foreach ($fields AS $f) {
			$field = array('label'=>$f['label'], 'type'=>$f['type']);
			$field['opts'] = json_decode($f['options'], true);
			if (!array_key_exists($f['name'], $fieldss)) $fieldss[$f['name']] = array($field);
			else $fieldss[$f['name']][] = $field;
		}

		foreach ($fieldss AS $fi=>$f) {
			if (count($f) > 1) {
				$tt = $form['name']."\n";
				foreach ($f AS $ffi=>$ff) {
					///$data[$fi][$ffi] = nl2br($data[$fi][$ffi]);
					$tt .= "{$ff['label']}: ";
					if ($ff['type'] == "boolean") {
						if ($data[$fi][$ffi]) $tt .= $ff['opts']['true'];
						else $tt .= $ff['opts']['false'];
					}
					else $tt .= "{$data[$fi][$ffi]}";
					$tt .= "\n";
				}
				///echo "<br>\$tt - {$tt}";
				//echo "\$tt - <pre>{$tt}</pre>";
				///$tt = nl2br($tt);
				///echo "<br>\$tt - {$tt}";
				$data[$fi] = $tt;
			}
			$data[$fi] = nl2br($data[$fi]);
		}

		if (array_key_exists("id", $opts) && $opts['id'] == -1) {
			//if (array_key_exists("created_at", ))
			//DB::table($table)->
			$data['created_at'] = date("Y-m-d H:i:s");
		} else if (array_key_exists("id", $opts)) {
			$data['updated_at'] = date("Y-m-d H:i:s");
		}

		//if (!array_key_exists("id", $data) && array_key_exists("id", $attr)) $data['id'] = $attr['id'];
		$txtDebug .= ", \$attr - ".print_r($attr, 1);
		$txtDebug .= ", \$data - ".print_r($data, 1);
		$txtDebug .= ", \$fields - ".print_r($fields, 1);
		$txtDebug .= ", \$fieldss - ".print_r($fieldss, 1);
		$saved = false;
		$table = $opts['table'];
		$txtDebug .= "\n  \$table - {$table}";
		if ($table == "") {
			$saved = parent::save($opts);
		} else {
			$dbTable = DbController::getTable($table);
			$primary = $dbTable['primary'][0];
			$txtDebug .= ", \$dbTable - ".print_r($dbTable, 1);
			$txtDebug .= "\n  \$primary - {$primary}";
			$keys = array_keys($data);
			$vals = array_values($data);
			$tosave = array($data);
			$res = DB::table($table);

			foreach ($data AS $key=>$val) {
				if (in_array($key, $dbTable['primary'])) continue;
				$res->where($key, "=",$val);
			}
			//die("<pre>{$txtDebug}</pre>");
			if ((array_key_exists("id", $attr) && $attr['id'] == -1) || (array_key_exists("id", $opts) && $opts['id'] == -1)) $saved = DB::table($table)->insert($data);
			else {
				if (array_key_exists("id", $attr)) $saved = DB::table($table)->where("id", $attr['id'])->update($data);
				else if (array_key_exists("id", $opts)) $saved = DB::table($table)->where("id", $opts['id'])->update($data);
			}
			
			//$txtDebug .= ", \$entry - ".print_r($entry, 1);
			$txtDebug .= ", \$res - ".print_r($res->toSql(), 1);//.", count - ".$res->count();
			$txtDebug .= "\n  bindings - ".print_r($res->getBindings(), 1);
			$item = null;

			/*if ($res->count() == 0) {
				//$item = $res->first();
			} else {

			}*/
//			die("<pre>{$txtDebug}</pre>");
			/*if ($opts[$primary] == -1) {
				$data['created_at'] = NULL;
				$data['updated_at'] = NULL;
				if ($res->count() == 0) $saved = DB::table($table)->insert($data);
			} else {
				
			}*/
			
			$txtDebug .= "\n  \$item - {$item}";
		}
		$txtDebug .= "\n  \$saved - ".var_export($saved, true);
		\Log::info($txtDebug);
		//die("<pre>{$txtDebug}</pre>");
		
		return $saved;
	}
}