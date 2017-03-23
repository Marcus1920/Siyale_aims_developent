<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {




        $cases = \DB::table('cases')
            ->join('departments', 'cases.department', '=', 'departments.id')
            ->join('municipalities', 'cases.precinct', '=', 'municipalities.id')
            ->join('users', 'cases.reporter', '=', 'users.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->select(
                        \DB::raw(
                                    "
                                        cases.id,
                                        cases.created_at,
                                        cases.description,
                                        cases.status,
                                        cases.priority,
                                        cases.severity,
                                        departments.name as department,
                                        municipalities.name as precinct,
                                        IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`FirstName`, ' ', `Surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporterName,
                                        categories.name as category
                                    "
                                )
                        )
            ->groupBy('cases.id');

        return \Datatables::of($cases)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>')
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
    public function show(Request $request)
    {


        $fromDate      = $request['fromDate']." 00:00:00";
        $toDate        = $request['toDate']." 23:59:59";
        $precinct      = $request['precinct'];
        if ($precinct == "0") {

            $precinct = "%";
        }

        $department    = $request['department'];

        if ($department == "0") {

             $department = "%";
        }

        $category      = $request['category'];
        if ($category == "0") {

            $category = "%";
        }

        $status = $request['status'];


        if ($status == "0") {

            $status = "%";
        }

        $reporter  = $request['reporter'];

        if ($reporter == "0") {

            $reporter = "%";
        }


        $cases = \DB::table('cases')
            ->join('departments', 'cases.department', '=', 'departments.id')
            ->join('municipalities', 'cases.precinct', '=', 'municipalities.id')
            ->join('users', 'cases.reporter', '=', 'users.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->select(
                        \DB::raw(
                                    "
                                        cases.id,
                                        cases.created_at,
                                        cases.description,
                                        cases.status,
                                        cases.priority,
                                        cases.severity,
                                        departments.name as department,
                                        municipalities.name as precinct,
                                        IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`FirstName`, ' ', `Surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporterName,
                                        categories.name as category
                                    "
                                )
                        )
            ->whereBetween('cases.created_at', array($fromDate,$toDate))
            ->where('municipalities.slug','LIKE',$precinct)
            ->where('departments.slug','LIKE',$department)
            ->where('categories.slug','LIKE',$category)
            ->where('cases.status','LIKE',$status)
            ->whereRaw("CONCAT(`users`.`name`, ' ', `users`.`surname`) LIKE '$reporter'")
            ->groupBy('cases.id');

        return \Datatables::of($cases)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>')
                            ->make(true);

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
