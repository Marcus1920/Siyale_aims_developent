<?php
	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Controller;
	use App\Form;
	use App\FormField;
	use App\FormsData;
	use App\Http\Controllers\DatabaseController AS DbController;
	use App\Http\Requests\FormsDataRequest;
	
	use Illuminate\Http\Request;
	use Illuminate\Http\Response;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\DB as DB;
	
	//use yajra\Datatables\Datatables;
	
  class FormsDataController extends Controller {
  	public $forms = array();
  	
  	/*public function __construct() {
			
  	}*/
  	
  	public function getData($req = array()) {
  		$txtDebug = "FormsDataController->getData(\$req = array()) \$req - ".print_r($req, 1).", \n\$_REQUEST - ".print_r($_REQUEST,1);
  		$search = $_REQUEST['search']['value'];
  		$query = FormsData::select(
  			"forms_data.id", 
  			DB::raw("DATE_FORMAT(forms_data.created_at, '%a, %d %b %Y<br>at %H:%i') AS created_att"), 
  			"form_id", 
  			"forms.name",
  			"forms_data.data",
  			DB::raw("CONCAT(forms.name,' (', form_id, ')') AS title")
  			)->leftJoin("forms", "forms.id", "=", "forms_data.form_id");
  			///if ($search) $query->havingRaw("created_att like '%{$search}%'");
  		//$query = FormsData::select(["forms_data.id", "form_id", "forms.name",DB::raw("forms.name AS title"),"forms_data.created_at", "forms_data.data"])->leftJoin("forms", "forms.id", "=", "forms_data.form_id");
  		//$query = $query->where(implode(", ", $req));
  		$txtDebug .= "\n  \$query - {$query->toSql()}";
  		$data = $query->get();
  		//$txtDebug .= "\n  \$data - ".print_r($data->toArray(), 1);
			//die("<pre>{$txtDebug}</pre>");
			/*return \Datatables::of($query)
				->addColumn('tits','WWWW')
				->addColumn('action','
		      <div class="col-md-2">
		          <select onchange="doAction(this,{{$id}});" class="form-control input-sm selFormOptions">
		              <option value="0">Select</option>
		              <option value="edit">Edit</option>
		              <option value="preview">Preview</option>
		              <option value="dataedit">Edit Data</option>
		              <option value="manage">Manage Data</option>
		              <option value="dataview">View Data</option>
		          </select>
		      </div>')*/
				/*->filterColumn('tits', function($query, $keyword) {
        	$query->whereRaw("CONCAT(forms.name,' (', form_id, ')') like ?", ["%{$keyword}%"]);
        })*/
        /*->filter(function ($query) use ($request) {
            if ($request->has('title')) {
                $query->where('name', 'like', "%{$request->get('title')}%");
            }
        })*/
        $datatables = \Datatables::of($query);
        //->filterColumn('title', 'whereRaw', "CONCAT(forms.name,' (', form_id, ')') like ? ", ["$search"]);
        ///$datatables->filterColumn("created_att", "whereRaw", "DATE_FORMAT(forms_data.created_at, '%a, %d %b %Y<br>at %H:%i') = '%34%'");
        $datatables->addColumn('actions','
	      <div class="col-md-2">
	          <select onchange="doAction(this,{{$id}},{what: \'data\', form_id: {{$form_id}} });" class="form-control input-sm selFormOptions">
	              <option value="0">Select</option>
	              <option value="edit">Edit</option>
	              <option value="view">View</option>
	              <option value="editform">Edit Form</option>
	          </select>
	      </div>');
				return $datatables->make(true);
  	}
  	
  	public function edit($id, $form_id = -1) {
  		$txtDebug = "FormsDataController->edit(\$id, \$form_id) \$id - {$id}, \$form_id - {$form_id}";
			$formdata = null;
			$data = null;
			//die("<pre>{$txtDebug}</pre>");
			if ($id != -1) {

				if ($form_id == -1) $form = Form::where('id',$form_id)->first()->toArray();
				else $form = Form::where('id',$form_id)->first()->toArray();
				if ($form['table']) {
					$formdata = new FormsData(array('form_id'=>$form_id));
					$formdata = $formdata->toArray();
					$data = \DB::table($form['table'])->where("id",$id)->first();//->toArray();
					$data = (array)$data;
					$data = json_encode($data);
					$formdata['data'] = $data;
					///$txtDebug .= "\n  \$formdata - ".print_r($formdata, 1)."";
					///die("<pre>{$txtDebug}</pre>");
				} else {
					$formdata = FormsData::where('id',$id)->first()->toArray();
				}
				$formdata['form'] = $form;
			}
			else {
				$formdata = new FormsData(array('form_id'=>$form_id));
				$formdata = $formdata->toArray();
				$form = Form::where('id',$formdata['form_id'])->first()->toArray();
				$formdata['form'] = $form;
			}
			$txtDebug .= "\n  \$formdata - ".print_r($formdata, 1)."";
			//die("<pre>{$txtDebug}</pre>");

			$fields = FormField::where('form_id',$formdata['form_id'])->orderBy("order", "asc")->get()->toArray();
			$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";

			if (array_key_exists("data", $formdata)) {
				if (is_string($formdata['data'])) $data = json_decode($formdata['data'], true);
				else $data = $formdata['data'];
			}
			else {
				$data = array();
				foreach ($fields AS $fi=>$f) {
					$data[$f['name']] = "";
				}
			}

			/*$fields_tmp = array();
			foreach ($fields AS $f) $fields_tmp[$f['name']][] = $f;
			$txtDebug .= "\n  \$fields_tmp - ".print_r($fields_tmp, 1)."";
			$fields = array();
			foreach ($fields_tmp AS $field) {
				if (count($field) == 1) $fields[] = $field[0];
				else $fields[] = $field[0];
			}*/
			$names = array();
			$names_tmp = array();
			foreach ($fields AS $f) if (!array_key_exists($f['name'], $names_tmp)) $names_tmp[$f['name']] = 1; else $names_tmp[$f['name']]++;
			$txtDebug .= "\n  \$names_tmp - ".print_r($names_tmp, 1)."";
			foreach ($names_tmp AS $name=>$cnt) if ($cnt == 1) $names[$name]= $name; else $names[$name] = "{$name}[]";
			$txtDebug .= "\n  \$names - ".print_r($names, 1)."";
			foreach ($fields AS $fi=>$f) $fields[$fi]['name'] = $names[$f['name']];
			//$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";
			//die("<pre>{$txtDebug}</pre>");
			foreach ($fields AS $fi=>$f) {
				$opts = json_decode($f['options'], true);
				if ($f['type'] == "rel") {
					$txtDebug .= "\n  Getting related shit for {$f['name']}, \$opts - ".print_r($opts,1);
					$key = $data[$f['name']];
					$val = [];
					$dbTable = DbController::getTable($opts['table']);
					$primary = implode(",", $dbTable['primary']);
					$txtDebug .= "\n    \$key - ".print_r($key,1);
					//$txtDebug .= "\n    \$dbTable - ".print_r($dbTable,1);
					$rel = (array)\DB::table($opts['table'])->where($primary, $key)->first();
					$txtDebug .= "\n    \$rel - ".print_r($rel,1);
					if (count($rel) > 0) foreach ($opts['display'] AS $display) $val[] = $rel[$display];
					$data[$f['name']] = array( $data[$f['name']], implode(" ", $val) );
				}
			}

			$txtDebug .= "\n  \$data - ".print_r($data, 1)."";
			$txtDebug .= "\n  \$formdata - ".print_r($formdata, 1)."";
			$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";
			$fff = array(
				'one'=>1
				, 'two'=>"2"
			);
			//die("<pre>{$txtDebug}</pre>");
			return [$form, $fields, $data];
  	}
  	
  	/**
  	* put your comment there...
  	* 
  	* @param FormsRequest $request
  	* 
  	* @return Response
  	*/
  	public function update(FormsDataRequest $request) {
  		//$input = Input::all();
  		$input = $request->all();
  		//if (array_key_exists("data", $input)) $input = $input['data'];
  		$txtDebug = "FormsDataController->update(FormsDataRequest \$request) \$request - ".print_r($request->all(), 1);
  		$txtDebug .= ", \$input - ".print_r($input, 1);
  		//$txtDebug = "FormsDataController->update(FormsRequest \$request) \$request - ".print_r($request, 1).", \$input - ".print_r($input,1);
  		//die("<pre>{$txtDebug}</pre>");
  		//$ajax = $input['ajax'] ?: 0;
  		$ajax = array_key_exists("ajax", $input) ? $input['ajax'] : 0;
  		//$ajax = var_export((bool)$input['ajax'],1);
  		$id = $input['id'];
  		$form_id = $input['formId'];
  		$fields = FormField::where('form_id',$form_id)->orderBy("order")->get()->toArray();
  		$table = "";
  		foreach ($fields AS $fi=>$f) if ($f['table']) $table = $f['table'];
  		$txtDebug .= "\n  \$table - {$table}, \$ajax - {$ajax} ( == true - ".($ajax == true).", == false - ".($ajax == false).")";
			$form = Form::where('id',$form_id)->first();//->toArray();
			$arrForm = $form->toArray();
			$txtDebug .= "\n  \$form - ".print_r($form,1);
			$txtDebug .= "\n  \$arrForm - ".print_r($arrForm,1);
  		//if ($table != "") $formdata->table = $table;
			if ($table) {
				$formdata = new FormsData(array('form_id'=>$form_id, 'table'=>$table));
			} else {
				if ($id != -1) $formdata = FormsData::where('id',$id)->first();//->toArray();
				else $formdata = new FormsData(array('form_id'=>$form_id, 'table'=>$table));
			}

			$data = array();
			$txtDebug .= "\n  Data Stuff";
  		foreach ($input['data'] AS $k=>$v) if (is_array($v)) {
  			$txtDebug .= "\n    Array";
				$data[$k] = json_encode($v);
				/*foreach ($v AS $vi=>$vv) {
					if ($vv == "") continue;
					foreach ($fields AS $fi=>$f) {
						//$fff = sprintf("%0.1f", $f['order']);
						list($whole, $frac) = sscanf($f['order'], "%d.%d");
						if ($frac == $vi) {
							$txtDebug .= "\n      \$frac - {$frac}, order - {$f['order']}, \$fi - {$fi}";
							//if (array_key_exists($k,$data)) $data[$k] .= "{$vv}";
							//else $data[$k] = "{$vv}";
							$optss = json_decode($f['options'], true);
							$joiner = "";
							if ($optss['joiner'] == "line") $joiner = "\n";
							else if ($optss['joiner'] == "comma") $joiner = ", ";
							else if ($optss['joiner'] == "space") $joiner = " ";
							$data[$k] .= "{$f['label']} - {$vv}{$joiner}";
						}
					}
					//if (array_key_exists($k,$data)) $data[$k] .= "\n{$vv}";
					//else $data[$k] = "{$vv}";
				}*/
			} else $data[$k] = $v;
			$txtDebug .= "\n  \$data - ".print_r($data,1);
			$data = json_encode($data);
			$txtDebug .= "\n  \$formdata - ".print_r($formdata,1);
			///die("<pre>{$txtDebug}</pre>");
  		$formdata->data = $data;

  		
  		$txtDebug .= "\n  \$data - ".print_r($data,1);
  		//$txtDebug .= "\n  \$formdata - ".print_r($formdata,1);
  		//
  		$txtDebug .= "\n  \$fields - ".print_r($fields, 1)."";
  		
  		$opts = array('id'=>$id, 'table'=>$table);
  		
  		//die("<pre>{$txtDebug}</pre>");
  		$saved = $formdata->save($opts);
  		if ($saved) \Session::flash('success', 'well done! Form Data has been successfully updated!');
  		else \Session::flash('failure', 'Whoops! Error updating Form Data');

  		if ($ajax) return json_encode($saved);
  		else return redirect()->back()->withInput();
		}
		
  	public function anyFormId($form_id = -1) {
  		//echo "FormsDataController->anyId(\$form_id = -1) \$form_id - {$form_id}";
			return self::anyIndex($form_id);
  	}
  	
  	public function anyIndex($form_id = -1) {
			$results = DB::table("forms")->select("id","name", "slug")->get();
			$forms = array('-1'=>"Select a form");
			foreach ($results AS $res) {
				$cnt = DB::table("forms_data")->where("form_id",$res->id)->count();
				//echo "\$cnt - <pre>".print_r($cnt,1)."</pre>";
				$forms[$res->id] = $res->name." ({$cnt})";
			}
			if ($form_id == -1 && Input::get("form_id") != -1) $form_id = Input::get("form_id");
			/*echo "FormsDataController->anyIndex(\$form_id = -1) \$form_id - {$form_id}";
			die("<pre>".print_r(Input::all(),1)."</pre>");*/
			return view("forms.data.list", ['forms'=>$forms, 'form_id'=>$form_id]);
  	}
  	
	}
?>
