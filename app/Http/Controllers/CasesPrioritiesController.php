<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CasePriorityRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CasePriority;

class CasesPrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = CasePriority::select(array('id','name','created_at'));
        return \Datatables::of($priorities)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateCasePriorityModal({{$id}});" data-target=".modalEditCasePriority">Edit</a>')
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
    public function store(CasePriorityRequest $request)
    {
        $casePriority               = new CasePriority();
        $casePriority->name         = $request['name'];
        $slug                       = preg_replace('/\s+/','-',$request['name']);
        $casePriority->slug         = $slug;
        $casePriority->created_by   = \Auth::user()->id;
        $casePriority->save();
        \Session::flash('success', 'well done! priority '.$request['name'].' has been successfully added!');
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
    public function edit($id,CasePriority $casePriority)
    {

        $case    = CasePriority::where('id',$id)->first();
        return [$case];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CasePriorityRequest $request)
    {

        $case               = CasePriority::where('id',$request['casePriorityId'])->first();
        $case->name         = $request['name'];
        $case->updated_by   = \Auth::user()->id;
        $case->save();
        \Session::flash('success', 'well done! case priority '.$request['name'].' has been successfully updated!');
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
