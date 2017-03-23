<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Position;
use App\Http\Requests\PositionsRequest;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $positions = Position::select(array('id','name','created_at'));
        return \Datatables::of($positions)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdatePositionModal({{$id}});" data-target=".modalEditPosition">Edit</a>')
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
    public function store(PositionsRequest $request)
    {
        $position       = new Position();
        $position->name = $request['name'];
        $slug           = preg_replace('/\s+/','-',$request['name']);
        $position->created_by = \Auth::user()->id;
        $position->slug = $slug;
        $position->save();
        \Session::flash('success', $request['name'].' position has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $searchString  = \Input::get('q');
        $positions     = \DB::table('positions')
            ->whereRaw("`name` LIKE '%{$searchString}%'")
            ->select(\DB::raw('*'))
            ->get();

        $data = array();

        if(count($positions) > 0)
        {

           foreach ($positions as $position) {

            $data[]= array("name"=>"{$position->name}","id" =>"{$position->id}");

           }


        }


        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $position    = Position::where('id',$id)->first();
        return [$position];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PositionsRequest $request)
    {
        $position       = Position::where('id',$request['positionID'])->first();
        $position->name = $request['name'];
        $position->updated_by = \Auth::user()->id;
        $position->save();
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
