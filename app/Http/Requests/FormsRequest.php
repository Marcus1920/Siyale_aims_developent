<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FormsRequest extends Request {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
  	//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
  	$rules = [
			'name'     =>'required|unique:forms,name,'.(isset($_REQUEST['formId'])? $_REQUEST['formId'] :"NULL")
			//'field.name' =>'required'
			, 'purpose'=>'required'
    ];
  	$table =  array_key_exists("table", $_REQUEST) ? $_REQUEST['table'] : "";
    if ($this->request->get("field")) {
    	//echo "<pre>".print_r($this->request->get("field"), 1)."</pre>";
    	//$rules['field.*.name'] = "required|unique:forms_fields";
			foreach ($this->request->get("field") as $key=>$val) {
				//echo "field[$key]<pre>".print_r($val, 1)."</pre>";
				/////$rules['field.'.$key.'.name'] = "required|unique:forms_fields,name,".(array_key_exists("id",$val)? $val['id']:"NULL").",id,form_id,".$_REQUEST['formId'].",table,".$table;//.",id";
				//$rules['field['.$key.'][name]'] = "required|unique:forms_fields";
				//$rules['field.name'] = "required";
				//$rules['field.label'] = "required";
			}
    }
    //die("rules<pre>".print_r($rules, 1)."</pre>");
    return $rules;
  }
}
