<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use App\GroupPermission;
use App\Http\Requests\PermissionsRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = \DB::table('permissions')
                        ->select(
                                    \DB::raw(
                                        "
                                         permissions.id,
                                         permissions.name
                                        "
                                      )
                                );


        return \Datatables::of($permissions)
                                ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchPermissionsModal({{$id}});" data-target=".modalEditPermission">Edit</a>')
                                ->make(true);

    }

    public function group_users_list($id)
    {
        $users = \DB::table('users')
                        ->where('role',$id)
                        ->select(
                                    \DB::raw(
                                        "
                                         users.id,
                                         users.name
                                        "
                                      )
                                );


        return \Datatables::of($users)
                                
                                ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
    {

        $permission    = Permission::where('id',$id)->first();
        return [$permission];
    }



    function list_permissions($id)
    {

         $groupPermissions = \DB::table('group_permissions')
                ->where('group_id','=',$id)
                ->join('permissions','permissions.id','=','group_permissions.permission_id')
                ->select(
                            \DB::raw("
                                        group_permissions.id,
                                        permissions.name


                                    "
                                        )
                        )
                ->groupBy('group_permissions.id');

        return \Datatables::of($groupPermissions)
                            ->make(true);






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionsRequest $request)
    {
        $permission               = Permission::where('id',$request['permissionId'])->first();
        $permission->name         = $request['name'];
        $permission->updated_by   = \Auth::user()->id;
        $permission->save();
        \Session::flash('success', 'well done! permission '.$request['name'].' has been successfully updated!');
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


 public function show()
    {

        $searchString = \Input::get('q');
        $permissions     = \DB::table('permissions')

                        ->whereRaw("CONCAT(`name`) LIKE '%{$searchString}%'")
                        ->select(\DB::raw('*'))
                        ->get();

        $data = array();

        if(count($permissions) > 0)
        {

           foreach ($permissions as $permission) {
           $data[]= array("name"=>"{$permission->name}","id" =>"{$permission->id}","name" =>"{$permission->name}");
           }


        }




        return $data;

    }




        public function storeGroupPermissions(Request $request)
    {

        
        $response  = array();

        $permissions = $request->get('checkbox-1');

        foreach ($permissions as $permission) {
           

                $groupPermission                    = new groupPermission();
                $groupPermission->group_id          = $request['groupID'];
                $groupPermission->permission_id     = $permission;
                $groupPermission->created_by        = \Auth::user()->id;
                $groupPermission->save();
        

        }

        $response["message"]   = "Permission Added!";
        $response["error"]     = FALSE;
        $response["groupID"] = $request['groupID'];

        return \Response::json($response,201);



    }

    public function removeGroupPermission(Request $request)
    {


        $response = array();

        foreach ($request['arr'] as $value) {

            $groupPermission = GroupPermission::find($value);
            $groupPermission->delete();

        }

        $response["message"]   = "Group Permission Deleted!";
        $response["error"]     = FALSE;
        $response["groupID"]   = $request['id'];

        return \Response::json($response,201);

    }







}
