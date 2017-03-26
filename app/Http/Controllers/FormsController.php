<?php
namespace App\Http\Controllers;

use App\FormsData;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatabaseController AS DbController;
use App\Form;  
use App\FormField;  
use App\Http\Requests\FormsRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB as DB;
//DB::connection()->disableQueryLog();

/**
 * Class FormsController
 * @package App\Http\Controllers
 * @
 */
class FormsController extends Controller {
	public function __construct() {
		$txtDebug = "FormsController::__construct()";
		/*try {
			throw new \Exception("WtF!?");
		} catch (Exception $ex) {
			//echo $ex->printStackTrace();
		}*/
		//parent::__construct();
		$tables = array("-- Select --");
		//$tables = DbController::getTables(true);
		$tables = array_merge(array(''=>"-- Select --"), DbController::getTables(true));
		//array_unshift($tables, array(''=>"-- Select --"));
		$txtDebug .= "\n  \$tables - ".print_r($tables, 1);
		\View::share('dbTables', $tables);
		//die("<pre>{$txtDebug}</pre>");
		\Log::info($txtDebug);
	}

	public function assigned($uid = null) {
		$txtDebug = "FormsController::assigned(\$uid = null) \$uid - $uid";
		$data = \DB::table('forms_assigned')
			->join("forms", "forms.id", "=", "forms_assigned.form_id")
			->select('forms_assigned.id','forms_assigned.data_id','forms_assigned.form_id','forms_assigned.due_at','forms_assigned.completed_at','forms_assigned.status', 'forms.name')
			->where('user_id','=',\Auth::user()->id)
			//->where('read','=',0)
			//->where('online','=',0)
		//	->get()
		;
		$txtDebug .= "\n  SQL - ".print_r($data->toSql(),1);
		$txtDebug .= "\n  \$data - ".print_r($data->get(),1);
		//die("<pre>{$txtDebug}</pre>");
		//return $data->get();
		return \Datatables::of($data)
			//->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateFormModal({{$id}}, true);" data-target=".modalEditForm">Edit</a> <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchPreviewFormModal({{$id}});" data-target=".modalPreviewForm">Preview</a>')
			->addColumn('actions','
	      <div class="col-md-2">
	          <select onchange="doAction(this,{{$data_id}}, { assigned_id: {{$id}},form_id: {{$form_id}}, what: \'data\' });" class="form-control input-sm selFormOptions">
	              <option value="0">Select</option>
	              <option value="view">View</option>
	              <option value="edit">Edit</option>
	              <option value="close">Close</option>
	              <option value="amend">Amend</option>
	          </select>
	      </div>')
			->make(true);
	}

	public function closeAssigned($id = null) {
		$txtDebug = "FormsController::closeAssigned(\$id = null) \$id - {$id}";
		if ($id) {
			$data = array('status'=>"complete", 'completed_at'=>date("Y-m-d H:i"));
			$txtDebug .= "\n  \$data - ".print_r($data,1);
			$saved = \DB::table("forms_assigned")->where("id", $id)->update($data);
			$txtDebug .= "\n  \$saved - {$saved}";
			if ($saved) {
				\Session::flash('success', 'Assigned form has been successfully closed!');
				return redirect()->back();
			}
			else {
				\Session::flash('failure', 'Whoops! Error closing assigned form');
				return redirect()->back()->withInput();
			}
		}
		//die("<pre>{$txtDebug}</pre>");
	}

	public function index() {
		$txtDebug = "FormsController->index()";
		//echo "<pre>$txtDebug<pre>";
		//$cntFields = FormField::select("count id")->where("form_id = 2");
		//$forms = Form::select(array('id','name','purpose','slug','created_at', Form::raw('1 AS cntFields')));
		///$forms = Form::select(array(Form::raw('1 as cntFields')));
		//$forms = Form::select(array('forms.id','forms.name','forms.purpose','forms.slug','forms.created_at', Form::raw('1 AS cntFields')));
		//->leftJoin("forms_fields","forms_fields.form_id", "=", "forms.id");//->leftJoinWhere("forms_fields", "forms.id", "=", "forms_fields.form_id");
		$forms = Form::select("forms.*", DB::raw('COUNT(forms_fields.id) as cntFields'), DB::raw("(select COUNT(forms_data.id) FROM forms_data WHERE forms_data.form_id = forms.id) as cntData"))
			->leftJoin("forms_fields", "forms.id", "=", "forms_fields.form_id")
			->groupBy("forms.id");
			//$forms = \DB::table("forms")->leftJoin("forms_fields", "forms.id", "=", "forms_fields.form_id")->select(\DB::raw("forms.`id`,forms.`name`, forms.`purpose`,COUNT(forms_fields.id) as cntFields"))->groupBy("forms.id");
		//\Session::flash('success', "SQL - ".$forms->toSql());
		//echo "SQL - ".$forms->toSql();
		//\View::share('selTables',array("case_notes", "cases"));

		return \Datatables::of($forms)
			//->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateFormModal({{$id}}, true);" data-target=".modalEditForm">Edit</a> <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchPreviewFormModal({{$id}});" data-target=".modalPreviewForm">Preview</a>')
			->addColumn('actions','
	      <div class="col-md-2">
	          <select onchange="doAction(this,{{$id}}, { what: \'form\' });" class="form-control input-sm selFormOptions">
	              <option value="0">Select</option>
	              <option value="assign">Assign</option>
	              <option value="delete">Delete</option>
	              <option value="edit">Edit</option>
	              <option value="preview">Preview</option>
	              <option value="manage">Manage Data</option>
	          </select>
	      </div>')
      	->make(true);
	}

	public function list_forms($id = null) {
		return view('forms.list', compact('id', $id));
	}

	public function assign($id = null) {
		$txtDebug = "FormsController->assign(\$id) \$id - {$id}";
		$req = $_REQUEST;
		$txtDebug .= "\n  \$req - ".print_r($req,1);
		$form = Form::where("id", $req['form_id'])->first()->toArray();
		$txtDebug .= "\n  \$form - ".print_r($form,1);
		$assigned = array();
		$now = date("Y-m-d H:i");

		if ($form['table'] == "") {

		} else {
			$dbTable = DbController::getTable($form['table']);
			$primary = $dbTable['primary'][0];
			$txtDebug .= ", \$dbTable - ".print_r($dbTable, 1);
			foreach ($req['users'] AS $uid) {
				$user = \App\User::where("id", $uid)->first()->toArray();
				$txtDebug .= ", \$user - ".print_r($user, 1);
				$queryAssigned = \DB::table("forms_assigned")->where("form_id", $form['id'])->where("user_id", $uid)->where("due_at", $req['due_date']);
				$txtDebug .= "\n  \$queryAssigned: count - ".$queryAssigned->count().", sql - {$queryAssigned->toSql()}, bindings - ".print_r($queryAssigned->getBindings(),1).", ".print_r($queryAssigned->first(),1);
				if ($queryAssigned->count() == 0) {
					$dataNew = array();
					foreach ($dbTable['columns'] AS $col) {
						if ($col['name'] == "created_at") $dataNew['created_at'] = $now;
						if ($col['name'] == "updated_at") $dataNew['updated_at'] = $now;
						if ($col['name'] == "created_by") $dataNew['created_by'] = $uid;
						if ($col['name'] == "updated_by") $dataNew['updated_by'] = $uid;
					}
					$idNew = \DB::table($form['table'])->insertGetId($dataNew);
					$txtDebug .= "\n    idNew - ".$idNew;
					$dataAssigned = array('form_id'=>$form['id'], 'user_id'=>$uid, 'data_id'=>$idNew, 'due_at'=>$req['due_date'], 'created_by'=>\Auth::user()->id, 'updated_by'=>\Auth::user()->id);
					$assigned[] = \DB::table("forms_assigned")->insertGetId($dataAssigned);
				} else {
					$dataExisting = (array)$queryAssigned->first();
					$txtDebug .= ", \$dataExisting - ".print_r($dataExisting, 1);
					foreach ($dbTable['columns'] AS $col) {
						if ($col['name'] == "updated_at") $dataExisting['updated_at'] = $now;
					}

					\Session::flash('failure', 'Form already assigned to '.$user['name'].' '.$user['surname'].' !');
					\Session::flash('failure', 'Form already assigned to '.$user['name'].' '.$user['surname'].' !');
				}
				//die("<pre>{$txtDebug}</pre>");


			}
		}
		$txtDebug .= "\n  \$assigned - ".print_r($assigned,1);
		//die("<pre>{$txtDebug}</pre>");
		\Session::flash('success', 'Form assigned to '.count($assigned).' users!');
		return redirect()->back();

	}

	public function delete($id = null) {
		//$req = Request::all();
		$txtDebug = "FormsController->delete(\$id) \$id - {$id}";
		//$txtDebug .= "\n  \$_REQUEST - ".print_r($_REQUEST, 1);
		//$txtDebug .= "\n  \$req - ".print_r($req, 1);
		if (!$id) $id = $_REQUEST['formId'];
		$form = Form::where('id',$id)->first()->toArray();
		$fields = FormField::select("*")->where('form_id', $id)->get();
		$data = null;
		$cntFields = $fields->count();
		$cntDeleted = array(0, 0, 0);
		$cntItems = 0;
		$table = "forms_data";
		if ($form['table'] == "") {
			$data = FormsData::where('form_id',$id)->get();
		} else {
			$table = $form['table'];
		}

		if ($data) $cntItems = $data->count();
		$txtDebug .= "\n  Deleting form {$id}";
		$txtDebug .= "\n    Deleting {$cntItems} items from {$table}";
		$deleted = 0;
		if ($data) foreach ($data AS $d) {
			$deleted = $d->delete();
			$cntDeleted[2] += $deleted;
			if ($deleted) $txtDebug .= "\n      Deleted item, \$deleted - {$deleted}";
			else $txtDebug .= "\n      Error deleting item, \$deleted - {$deleted}";
		}
		$txtDebug .= "\n    Deleting {$cntFields} fields";
		/*for ($i = 0; $i < $fields->count(); $i++) {
			$deleted = FormField::delete();
		}*/
		$deleted = 0;
		foreach ($fields AS $f) {
			$deleted = $f->delete();
			$cntDeleted[1] += $deleted;
			if ($deleted) $txtDebug .= "\n      Deleted field, \$deleted - {$deleted}";
			else $txtDebug .= "\n      Error deleting field, \$deleted - {$deleted}";
		}
		$deleted = 0;
		if ($cntDeleted[1] == $cntFields) {
			$deleted = Form::where('id',$id)->delete();
			$cntDeleted[0] = $deleted;
			if ($cntDeleted[0]) $txtDebug .= "\n    Deleted form, \$deleted - {$deleted}";
			else $txtDebug .= "\n    Error deleting field, \$deleted - {$deleted}";
		}
		$txtDebug .= "\n    Deleted {$cntDeleted[0]} form, {$cntDeleted[1]} of {$cntFields} field(s) & {$cntDeleted[2]} of {$cntItems} item(s)";
		$txtDebug .= "\n  \$form - ".print_r($form, 1);
		$txtDebug .= "\n  \$fields - ".print_r($fields->toArray(), 1);
		$txtDebug .= "\n  \$data - ".print_r(($data != null ? $data->toArray() : array()), 1);
		//die("<pre>{$txtDebug}</pre>");
		if ($cntDeleted[0]) {
			\Session::flash('success', "Deleted form & {$cntDeleted[1]} of {$cntFields} field(s) & {$cntDeleted[2]} of {$cntItems} item(s)");
			return redirect()->back();
		} else {
			\Session::flash('failure', "Whoops! Error deleting form! Deleted {$cntDeleted[1]} of {$cntFields} field(s) & {$cntDeleted[2]} of {$cntItems} item(s)");
			return redirect()->back()->withInput();
		}
	}
	
	public function edit($id) {
		//echo "FormsController->edit(\$id) \$id - {$id}";
    $form = Form::where('id',$id)->first();
    $fields = FormField::select("*")->where('form_id', $id)->orderBy("order")->get();
    //echo "\$form<pre>".print_r($form, 1)."</pre>";
    //echo "\$fields<pre>".print_r($fields, 1)."</pre>";
   	return [$form, $fields];
  }
  
  public function store(FormsRequest $request) {
		$txtDebug = "FormsController->store(\$request)";
		if ($request) $req = $request->all();
		if ($req['slug'] == "") $req['slug'] = strtolower( preg_replace('/\s/','-', $req['name']) );
		$txtDebug .= " \$req A - ".print_r($req,1);
  	$form             = new Form();
		/*$form->name       = $request['name'];
		$form->slug       = $request['slug'];
		$form->purpose   = $request['purpose'];
		$form->table = $request['table'];
		$form->created_by = \Auth::user()->id;*/
		if (!array_key_exists("created_by", $req)) $req['created_by'] = \Auth::user()->id;
		$txtDebug .= " \$req B - ".print_r($req,1);
		$form->fill($req);
		$txtDebug .= "\n  \$form - ".print_r($form->toArray(), 1);
		//die("<pre>{$txtDebug}</pre>");
		\Log::info($txtDebug);
		$saved = $form->save();
		\Log::info("  \$saved - {$saved}");
		if ($saved) {
			\Session::flash('success', $request['name'].' form has been successfully added!');
			return redirect()->back();
		}
		else {
			\Session::flash('failure', 'Whoops! Error updating Form Data');
			return redirect()->back()->withInput();
		}

	}
  
  /**
  * Update the form
  * 
  * @param Request $request
  * @return Response
  */
  public function update(FormsRequest $request) {
		$txtDebug = "FormsController->update(\$request)";
		$req = array();
		if ($request) {
			$req = $request->all();
			$txtDebug .= "\n  \$request - ".print_r($request->all(),1);
			//$fields = $request['field'];
		}
		//die("<pre>{$txtDebug}</pre>");
		if ($req['slug'] == "") $req['slug'] = strtolower( preg_replace('/\s/','-', $req['name']) );
		if (!array_key_exists("updated_by", $req)) $req['updated_by'] = \Auth::user()->id;
		//if (!array_key_exists("updated_at", $req)) $req['updated_at'] = date("Y-m-d H:i:s");
		if (array_key_exists("field", $req)) {
		foreach($req['field'] AS $i=>$f) {
			$joiner = array_key_exists("joiner", $f['opts']) ? $f['opts']['joiner'] : "line";
			$req['field'][$i]['opts'] = $f['opts'][$f['type']];
			$req['field'][$i]['opts']['joiner'] = $joiner;
			if ($f['type'] == "choice" && !array_key_exists("options", $req['field'][$i]['opts'])) $req['field'][$i]['opts']['options'] = array();
		}
		$txtDebug .= "  \$fields - ".print_r($req['field'],1)."";
		}

  	$form               = Form::where('id',$request['formId'])->first();
    /*$form->name         = $request['name'];
    $form->purpose   = $request['purpose'];
		$form->table = $request['table'];
    $form->updated_by   = \Auth::user()->id;*/
    //$txtDebug .= "  \$request - ".print_r($request->all(),1)."";
		$txtDebug .= "\n  \$form A - ".print_r($form->toArray(), 1);
		$form->fill($req);
		$txtDebug .= "\n  \$form B - ".print_r($form->toArray(), 1);
		//die("<pre>{$txtDebug}</pre>");
		\Log::info($txtDebug);
    $saved = $form->save();
		\Log::info("  \$saved - {$saved}");
    if (array_key_exists("field", $req)) $saved = $form->saveFields($req, $this);
		\Log::info("  \$saved - {$saved}");
		//die("<pre>{$txtDebug}</pre>");
    //die("<pre>FormsController->update(\$request) \$request - ".print_r($request->all(),1)."</pre>");
    //\Session::flash('success', "REQUEST<pre>".print_r($request, 1)."</pre>");
    if ($saved) {
			\Session::flash('success', 'well done! Form '.$request['name'].' has been successfully updated!');
    	return redirect("list-forms");
		} else {
			\Session::flash('failure', 'Whoops! Error updating Form Data');
    	return redirect()->back()->withInput();
		}
  }
}
?>
