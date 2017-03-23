<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseReport;
use App\CaseOwner;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {


        if (\Auth::check())
        {

            if (\Auth::user()->role == 1) {

                $numberReferredCases = \DB::table('cases')
                                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                ->where('cases_statuses.name','<>','Pending Closure')
                                ->where('cases_statuses.name','<>','Resolved')
                                ->where('cases_statuses.name','<>','Pending')
                                ->groupBy('cases.id')
                                ->get();

                $numberPendingClosureCases = \DB::table('cases')
                                            ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                            ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                            ->where('cases_statuses.name','=','Pending Closure')
                                            ->groupBy('cases.id')
                                            ->get();

                $numberResolvedCases = \DB::table('cases')
                                        ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                        ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                        ->where('cases_statuses.name','=','Resolved')


                                        ->groupBy('cases.id')
                                        ->get();

                $numberPendingCases = \DB::table('cases')
                                        ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                        ->where('cases_statuses.name','=','Pending')
                                        ->get();

            }
            else {



                if (\Auth::user()->role == 2) {


                        $numberReferredCases = \DB::table('cases')
                                        ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                        ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                        ->where('cases_statuses.name','<>','Pending Closure')
                                        ->where('cases_statuses.name','<>','Resolved')
                                        ->where('cases_statuses.name','<>','Pending')
                                        ->where('cases.user','=',\Auth::user()->id )
                                        ->groupBy('cases.id')
                                        ->get();

                        $numberPendingClosureCases = \DB::table('cases')
                                                    ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                                    ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                                    ->where('cases_statuses.name','=','Pending Closure')
                                                    ->where('cases.user','=',\Auth::user()->id)
                                                    ->groupBy('cases.id')
                                                    ->get();

                        $numberResolvedCases = \DB::table('cases')
                                                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')

                                                ->where('cases_statuses.name','=','Resolved')

                                                ->where('cases.user','=',\Auth::user()->id)
                                                ->groupBy('cases.id')
                                                ->get();

                        $numberPendingCases = \DB::table('cases')
                                                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                                                ->where('cases.user','=',\Auth::user()->id)
                                                ->where('cases_statuses.name','=','Pending')
                                                ->get();




                }
                else {


                        $numberReferredCases = \DB::table('cases')
                                                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                                ->where('cases.status','<>','Pending Closure')
                                                ->where('cases.status','<>','Resolved')
                                                ->where('cases_owners.user','=',\Auth::user()->id)
                                                ->groupBy('cases.id')
                                                ->get();

                        $numberPendingClosureCases = \DB::table('cases')
                                                    ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                                    ->where('cases.status','=','Pending Closure')
                                                    ->where('cases_owners.user','=',\Auth::user()->id)
                                                    ->groupBy('cases.id')
                                                    ->get();

                        $numberResolvedCases = \DB::table('cases')
                                                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                                                ->where('cases.status','=','Resolved')
                                                ->where('cases_owners.user','=',\Auth::user()->id)
                                                ->groupBy('cases.id')
                                                ->get();


                }












            }


        $userViewAllocatateReferredCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',17)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


       $userViewPendingAllocationCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',18)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();



        $userViewPendingClosureCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',19)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


        $userViewResolvedCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',20)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userCreateCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',21)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


        $userAllocateCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',22)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userAcceptCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',23)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userReferCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',24)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userAddCasesNotesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',25)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


        $userAddCasesFilesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',26)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userViewWorkFlowPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',27)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userCloseCasePermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',28)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        $userRequestCaseClosurePermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',29)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

         $userAddPoiPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',30)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


            return view('home.home',compact('userAddPoiPermission','userRequestCaseClosurePermission','userCloseCasePermission','userViewWorkFlowPermission','userAddCasesNotesPermission','userAddCasesFilesPermission','userReferCasesPermission','userAcceptCasesPermission','userAllocateCasesPermission','userCreateCasesPermission','userViewAllocatateReferredCasesPermission','userViewPendingAllocationCasesPermission','userViewPendingClosureCasesPermission','userViewResolvedCasesPermission','numberReferredCases','numberPendingClosureCases','numberResolvedCases','numberPendingCases'));

        }
        else {

            \Auth::logout();
        }

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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
