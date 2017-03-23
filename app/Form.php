<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB as DB;
use App\FormField;

class Form extends Eloquent {
	protected $table    = 'forms';
	protected $fillable = ['name','slug','active', 'table', 'purpose'];
	
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
		$txtDebug = "saveFields(req) form_id - {$form_id}, fields<pre>".print_r($fields, 1)."</pre>";
		$txtDebug .= "\n  fullUrlWithQuery - <pre>".print_r($req->input(),1)."</pre>";
		\Session::flash('success', "saveFields(req)");
		\Session::flash('success', "fields<pre>".print_r($fields, 1)."</pre>");
		$saved = true;
		$ids = [];
		if (count($fields) > 0) foreach ($fields AS $i=>$field) if ($field['id']) {
			$ids[] = $field['id'];
		}
		$txtDebug .= "\n  \$ids<pre>".print_r($ids, 1)."</pre>";
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
				}	
				/////$field = array('id'=>$field_id);
				/////if ($field_id == -1) $field = array('form_id'=>$form_id, 'name'=>$fields['name'][$i]);
				//if ($field_id == -1) $field = array('form_id'=>$form_id, 'name'=>$fields['name'][$i], 'type'=>$fields['type'][$i]);
				//$ff = FormField::where(array('form_id'=>$form_id))->first();
				$ff = FormField::where(array('id'=>$field['id']))->first();
				if (!$ff) $ff = new FormField();
				$ff->fill($field);
				$txtDebug .= "\n  ff - <pre>".print_r($ff->toArray(), 1)."</pre>";
				$saved = $ff->save();
			}
		}
		//parent::save();
		//die("<pre>$txtDebug<pre>");
		return $saved;
	}
}
