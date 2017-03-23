<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DepartmentRequest;
use App\Http\Controllers\Controller;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $departments = Department::select(array('id','name','created_at','acronym'));
        return \Datatables::of($departments)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateDepartmentModal({{$id}});" data-target=".modalEditDepartment">Edit</a>')
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(DepartmentRequest $request)
    {
        $department          = new Department();
        $department->name    = $request['name'];
        $department->acronym = $request['acronym'];
        $slug                = preg_replace('/\s+/','-',$request['name']);
        $department->slug    = $slug;
        $department->created_by = \Auth::user()->id;
        $department->save();
        \Session::flash('success', 'well done! Department '.$request['name'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id,Department $department)
    {

        $dept    = Department::where('id',$id)->first();
        return [$dept];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(DepartmentRequest $request)
    {

        $dept             = Department::where('id',$request['deptID'])->first();
        $dept->name       = $request['name'];
        $dept->acronym    = $request['acronym'];
        $dept->updated_by = \Auth::user()->id;
        $dept->save();
        \Session::flash('success', 'well done! Role '.$request['name'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
