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
		//if (!array_key_exists("id", $data) && array_key_exists("id", $attr)) $data['id'] = $attr['id'];
		$txtDebug .= ", \$attr - ".print_r($attr, 1);
		$txtDebug .= ", \$data - ".print_r($data, 1);
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
			if ($opts[$primary] == -1) {
				$data['created_at'] = NULL;
				$data['updated_at'] = NULL;
				if ($res->count() == 0) $saved = DB::table($table)->insert($data);
			} else {
				
			}
			
			$txtDebug .= "\n  \$item - {$item}";
		}
		$txtDebug .= "\n  \$saved - ".var_export($saved, true);
		//die("<pre>{$txtDebug}</pre>");
		
		return $saved;
	}
}