<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MunicipalityRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Municipality;

class MunicipalitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $municipalities = Municipality::where('district','=',$id)
                                        ->select(array('id','name','slug','created_at'));
        return \Datatables::of($municipalities)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateMunicipalityModal({{$id}});" data-target=".modalEditMunicipality">Edit</a>')
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


   public function store(MunicipalityRequest $request)
    {
         $municipality             = new Municipality();
         $municipality->name       = $request['name'];
         $municipality->slug       = $request['slug'];
         $municipality->district   = $request['districtID'];
         $municipality->created_by = \Auth::user()->id;
         $municipality->save();
        \Session::flash('success', $request['name'].' municipality has been successfully added!');
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
    public function edit($id,Municipality $municipality)
    {

        $municipality    = Municipality::where('id',$id)->first();
        return [$municipality];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(MunicipalityRequest $request)
    {
        $municipality       = Municipality::where('id',$request['municipalityID'])->first();
        $municipality->name = $request['name'];
        $municipality->updated_by = \Auth::user()->id;
        $municipality->save();
        \Session::flash('success', 'well done! Municipality '.$request['name'].' has been successfully added!');
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
