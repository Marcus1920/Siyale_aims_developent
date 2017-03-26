<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB as DB;
use App\FormField;

class Form extends Eloquent {
	protected $table    = 'forms';
	protected $fillable = ['name','slug','active', 'table', 'purpose', 'created_by', 'updated_by'];
	
	public function save(array $options = array()) {
		$txtDebug = "save(\$options) \$options - ".print_r($options,1);
		//echo "<pre>$txtDebug<pre>";
		//die("<pre>$txtDebug<pre>");
		return parent::save($options);
	}
	
	public function saveFields($req, $fff) {
		$form_id = $req['formId'];
		$fields = $req['field'];
		$table = $req['table'];
		//$txtDebug = "saveFields(req) form_id - {$form_id}, fields<pre>".print_r($fields, 1)."</pre>";
		/*$txtDebug = "saveFields(req) form_id - {$form_id}";
		$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";
		$txtDebug .= "\n  \$fff - ".print_r($fff, 1)."";
		$txtDebug .= "\n  fullUrlWithQuery - ".print_r($req,1)."";
		*/
		$txtDebug = "saveFields(req) form_id - {$form_id}";
		$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";
		$txtDebug .= "\n  \$fff - ".print_r($fff, 1)."";
		$txtDebug .= "\n  fullUrlWithQuery - ".print_r($req,1)."";
		\Session::flash('success', "saveFields(req)");
		\Session::flash('success', "fields<pre>".print_r($fields, 1)."</pre>");
		$saved = true;
		$ids = [];
		if (count($fields) > 0) foreach ($fields AS $i=>$field) if ($field['id']) {
			$ids[] = $field['id'];
		}
		$txtDebug .= "\n  \$ids - ".print_r($ids, 1)."";
		$sqlDelete = "DELETE FROM forms_fields WHERE form_id = {$form_id}";
		if (count($ids) > 0) $sqlDelete .= " AND id NOT IN (".implode(",", $ids).") ";
		$txtDebug .= "\n  \$sqlDelete - {$sqlDelete}";
		\DB::delete($sqlDelete);
		if (count($fields) > 0) {
			foreach ($fields AS $i=>$field) {
				$field['form_id'] = $form_id;
				$field['order'] = $field['order'];
				$field['table'] = $table;
				/*$fff->validate($field, [
					'name'=>"required"
				]);*/
				if (array_key_exists($field['type'], $field['opts'])) {
					if ($field['type'] == "rel") {
						//$field['opts'][$field['type']]['display'] = "";
					}
					$field['options'] = json_encode($field['opts'][$field['type']]);
				}	else $field['options'] = json_encode($field['opts']);
				/////$field = array('id'=>$field_id);
				/////if ($field_id == -1) $field = array('form_id'=>$form_id, 'name'=>$fields['name'][$i]);
				//if ($field_id == -1) $field = array('form_id'=>$form_id, 'name'=>$fields['name'][$i], 'type'=>$fields['type'][$i]);
				//$ff = FormField::where(array('form_id'=>$form_id))->first();
				/*$ff = FormField::where(array('id'=>$field['id']))->first();
				$txtDebug .= "\n  ff A - ".print_r(($ff != null ? $ff->toArray() : null), 1)."";
				if (!$ff) $ff = new FormField();*/
				$txtDebug .= "\n  \$field - ".print_r($field, 1)."";
				$ff = FormField::findOrNew($field['id']);
				//$ff = FormField::findOrFail(1);
				$txtDebug .= "\n  ff Ca - ".print_r($ff->toArray(), 1)."";
				$ff->fill($field);
				$txtDebug .= "\n  ff Cb - ".print_r($ff->toArray(), 1)."";
				$saved = $ff->save();
			}
		}
		//parent::save();
		\Log::info($txtDebug);
		///die("<pre>$txtDebug<pre>");
		//echo "<pre>$txtDebug<pre>";
		return $saved;
	}
}
