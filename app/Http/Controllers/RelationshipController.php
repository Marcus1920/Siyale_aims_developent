<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Relationship;
use App\Http\Requests\RelationshipsRequest;

class RelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $relationships = Relationship::select(array('id','name','created_at'));
        return \Datatables::of($relationships)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateRelationshipModal({{$id}});" data-target=".modalEditRelationship">Edit</a>')
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
    public function store(RelationshipsRequest $request)
    {
        $relatitionship       = new Relationship();
        $relatitionship->name = $request['name'];
        $relatitionship->created_by = \Auth::user()->id;
        $slug           = preg_replace('/\s+/','-',$request['name']);
        $relatitionship->slug = $slug;
        $relatitionship->save();
        \Session::flash('success', $request['name'].' has been successfully added!');
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
    public function edit($id)
    {
        $relationship    = Relationship::where('id',$id)->first();
        return [$relationship];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RelationshipsRequest $request)
    {
        $relationship       = Relationship::where('id',$request['relationshipID'])->first();
        $relationship->name = $request['name'];
        $relationship->updated_by = \Auth::user()->id;
        $relationship->save();
        \Session::flash('success', $request['name'].' has been successfully updated!');
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
