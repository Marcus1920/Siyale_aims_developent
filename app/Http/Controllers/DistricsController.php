<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\District;

class DistricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::select(array('id','name','slug','created_at'));
        return \Datatables::of($districts)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateDistrictModal({{$id}});" data-target=".modalEditDistrict">Edit</a>')
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


   public function store(DistrictRequest $request)
    {
         $district             = new District();
         $district->name       = $request['name'];
         $district->slug       = $request['slug'];
         $district->province   = $request['provinceID'];
         $district->created_by = \Auth::user()->id;
         $district->save();
        \Session::flash('success', $request['name'].' district has been successfully added!');
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
    public function edit($id,District $district)
    {

        $district    = District::where('id',$id)->first();
        return [$district];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request)
    {
        $district       = District::where('id',$request['districtID'])->first();
        $district->name = $request['name'];
        $district->updated_by = \Auth::user()->id;
        $district->save();
        \Session::flash('success', 'well done! District '.$request['name'].' has been successfully added!');
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
