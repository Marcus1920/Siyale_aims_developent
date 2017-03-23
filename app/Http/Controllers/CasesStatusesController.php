<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CaseStatusRequest;
use App\Http\Controllers\Controller;
use App\CaseStatus;

class CasesStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = CaseStatus::select(array('id','name','created_at'));
        return \Datatables::of($statuses)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateCaseStatusModal({{$id}});" data-target=".modalEditCaseStatus">Edit</a>')
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
    public function store(CaseStatusRequest $request)
    {
        $caseStatus       = new CaseStatus();
        $caseStatus->name = $request['name'];
        $slug             = preg_replace('/\s+/','-',$request['name']);
        $caseStatus->slug = $slug;
        $caseStatus->created_by = \Auth::user()->id;
        $caseStatus->save();
        \Session::flash('success', 'well done! Status '.$request['name'].' has been successfully added!');
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
    public function edit($id,CaseStatus $caseStatus)
    {

        $case    = CaseStatus::where('id',$id)->first();
        return [$case];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaseStatusRequest $request)
    {

        $case       = CaseStatus::where('id',$request['caseStatusId'])->first();
        $case->name = $request['name'];
        $case->updated_by = \Auth::user()->id;
        $case->save();
        \Session::flash('success', 'well done! Case '.$request['name'].' has been successfully updated!');
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
