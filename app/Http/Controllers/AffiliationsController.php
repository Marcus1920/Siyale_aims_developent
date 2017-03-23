<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AffiliationRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AffiliationPositions;
use App\Affiliation;
use App\Position;


class AffiliationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $affiliations = Affiliation::select(array('id','name','created_at'));
        return \Datatables::of($affiliations)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateAffiliationModal({{$id}});" data-target=".modalEditAffiliation">Edit</a>')
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
    public function store(AffiliationRequest $request)
    {

        $affiliation             = new Affiliation();
        $affiliation->name       = $request['name'];
        $slug                    = preg_replace('/\s+/','-',$request['name']);
        $affiliation->slug       = $slug;
        $affiliation->created_by = \Auth::user()->id;
        $affiliation->save();
        \Session::flash('success', 'well done! affiliation '.$request['name'].' has been successfully added!');
        return redirect()->back();
    }

    public function addAffiliationPosition(Request $request)
    {


     $AffiliationPositionsObj = AffiliationPositions::where('affiliation','=',$request['affiliationID'])
                                                      ->where('position','=',$request['affiliationPositions'])
                                                      ->first();

      \Log::info(sizeof($AffiliationPositionsObj));

      if (sizeof($AffiliationPositionsObj) == 0) {

          $affiliationPosition              = new AffiliationPositions();
          $affiliationPosition->affiliation = $request['affiliationID'];
          $affiliationPosition->position    = $request['affiliationPositions'];
          $affiliationPosition->created_by  = \Auth::user()->id;
          $affiliationPosition->save();
          \Session::flash('success', 'well done! affiliation position has been successfully added!');
          return redirect()->back();

      } else {

          \Session::flash('error', 'oh snap! affiliation position already exist!');
          return redirect()->back();


      }




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

        $affilition    = Affiliation::where('id',$id)->first();
        return [$affilition];
    }


    public function getAffiliationPositions($id)
    {

       $affiliationPositions = AffiliationPositions::where('affiliation','=',$id)
                                                        ->select('position')
                                                        ->get();

        $positionsIds = array();

       if (sizeof($affiliationPositions) > 0) {

        foreach ($affiliationPositions as $affiliationPosition) {

            $positionsIds[] = $affiliationPosition->position;

        }

        $affiliationPositions    = Position::whereIn('id', $positionsIds)
                                            ->select(array('id','name','created_at'));
        return \Datatables::of($affiliationPositions)
                            ->addColumn('actions','')
                            ->make(true);

       }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AffiliationRequest $request)
    {
        $affiliation               = Affiliation::where('id',$request['affiliationId'])->first();
        $affiliation->name         = $request['name'];
        $affiliation->updated_by   = \Auth::user()->id;
        $affiliation->save();
        \Session::flash('success', 'well done! affiliation '.$request['name'].' has been successfully updated!');
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
