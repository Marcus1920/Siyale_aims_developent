<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserRole;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = UserRole::select(array('id','name','created_at'));
        return \Datatables::of($roles)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateRoleModal({{$id}});" data-target=".modalEditRole">Edit</a>
                                                    <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchPermissions({{$id}});" data-target=".modalAddRolePermissions">Assign Permissions</a>

                                ')
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $role             = new UserRole();
        $role->name       = $request['name'];
        $slug             = preg_replace('/\s+/','-',$request['name']);
        $role->slug       = $slug;
        $role->created_by = \Auth::user()->id;
        $role->save();
        \Session::flash('success', 'well done! User Group '.$request['name'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role    = UserRole::where('id',$id)->first();
        return [$role];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request)
    {
        $role             = UserRole::where('id',$request['roleID'])->first();
        $role->name       = $request['name'];
        $role->updated_by = \Auth::user()->id;
        $role->save();
        \Session::flash('success', 'well done! User Group '.$request['name'].' has been successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
