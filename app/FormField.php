<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class FormField extends Eloquent {
	protected $table    = 'forms_fields';
	protected $fillable = ['form_id','label','name','desc','order','type','options', 'table'];
	
	/*public function saveFields($id) {
		$saved = true;
		//parent::save();
		return $saved;
	}*/
}
