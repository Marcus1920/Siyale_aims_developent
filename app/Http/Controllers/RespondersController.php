<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseResponder;

class RespondersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

        $caseResponders = \DB::table('cases_owners')
                        ->where('case_id','=',$id)
                        ->join('users','users.id','=','cases_owners.user')
                        ->select(
                                    array(
                                            'users.id',
                                            'users.name',
                                            'users.surname',
                                            'users.cellphone',
                                            'cases_owners.type',
                                            'cases_owners.accept'
                                        )
                                );

        return \Datatables::of($caseResponders)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-dest="{{$id}}" data-name="{{$name}} {{$surname}}" data-toggle="modal" onClick="launchMessageModal({{$id}},this);" data-target=".compose-message"><i class="fa fa-envelope"></i></a>'
                                       )
                            ->make(true);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeSubSubResponder(Request $request)
    {

        $sub_sub_cat = $request['subsubCategoryID'];
        $result = CaseResponder::where('sub_sub_category','=',$sub_sub_cat)->first();

        if($result)
        {
            $result->first_responder   = $request['firstResponder'];
            $result->second_responder  = $request['secondResponder'];
            $result->third_responder   = $request['thirdResponder'];
            $result->created_by        = \Auth::user()->id;
            $result->save();
            \Session::flash('success','Responders have been successfully added!');
            return redirect()->back();



        }
        else {

            $responder                   = new CaseResponder();
            $responder->department       = $request['deptID'];
            $responder->category         = $request['catID'];
            $responder->sub_category     = $request['subCatID'];
            $responder->sub_sub_category = $request['subsubCategoryID'];
            $responder->first_responder  = $request['firstResponder'];
            $responder->second_responder = $request['secondResponder'];
            $responder->third_responder  = $request['thirdResponder'];
            $responder->created_by       = \Auth::user()->id;
            $responder->active           = 1;
            $responder->save();

        \Session::flash('success','Responders have been successfully added!');
        return redirect()->back();




        }

    }


      public function storeSubResponder(Request $request)
    {


        $sub_cat = $request['subCatID'];
        $result  = CaseResponder::where('sub_category','=',$sub_cat)
                                ->where('sub_sub_category','=',0)
                                ->first();

        if($result)
        {
            $result->first_responder   = $request['firstResponder'];
            $result->second_responder  = $request['secondResponder'];
            $result->third_responder   = $request['thirdResponder'];
            $result->created_by        = \Auth::user()->id;
            $result->save();
            \Session::flash('success','Responders have been successfully added!');
            return redirect()->back();



        }
        else {

            $responder                   = new CaseResponder();
            $responder->department       = $request['deptID'];
            $responder->category         = $request['catID'];
            $responder->sub_category     = $request['subCatID'];
            $responder->first_responder  = $request['firstResponder'];
            $responder->second_responder = $request['secondResponder'];
            $responder->third_responder  = $request['thirdResponder'];
            $responder->created_by       = \Auth::user()->id;
            $responder->active           = 1;
            $responder->save();

        \Session::flash('success','Responders have been successfully added!');
        return redirect()->back();




        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    public function subResponder($id)
    {

        $firstRespondersObj  = CaseResponder::where("sub_category",'=',$id)
                                                ->select('first_responder')->first();

        $secondRespondersObj = CaseResponder::where("sub_category",'=',$id)
                                                ->select('second_responder')->first();

        $thirdRespondersObj  = CaseResponder::where("sub_category",'=',$id)
                                                ->select('third_responder')->first();

        $response            = array();

        if (sizeof($firstRespondersObj) > 0) {

            $firstResponders = explode(",",$firstRespondersObj->first_responder);

                if ($firstRespondersObj->first_responder > 0) {

                           foreach ($firstResponders as $firstResponder) {

                             $user = \DB::table('users')
                                        ->where('id','=',$firstResponder)
                                        ->select(\DB::raw(
                                                    "
                                                    id,
                                                    (select CONCAT(name, ' ',surname) ) as firstResponder

                                                    "
                                                      )
                                                )->first();

                            $response[] = $user;

                            }

                }

        }

        if (sizeof($secondRespondersObj) > 0) {

            $secondResponders = explode(",",$secondRespondersObj->second_responder);

            if ($secondRespondersObj->second_responder > 0) {

                foreach ($secondResponders as $secondResponder) {

                     $user = \DB::table('users')
                                ->where('id','=',$secondResponder)
                                ->select(\DB::raw(
                                            "
                                            id,
                                            (select CONCAT(name, ' ',surname) ) as secondResponder

                                            "
                                              )
                                        )->first();

                    $response[] = $user;

                 }

            }

        }

        if (sizeof($thirdRespondersObj) > 0) {

            $thirdResponders  = explode(",",$thirdRespondersObj->third_responder);

            if ($thirdRespondersObj->third_responder > 0) {

                 foreach ($thirdResponders as $thirdResponder) {

                     $user = \DB::table('users')
                                ->where('id','=',$thirdResponder)
                                ->select(\DB::raw(
                                            "
                                            id,
                                            (select CONCAT(name, ' ',surname) ) as thirdResponder

                                            "
                                              )
                                        )->first();

                    $response[] = $user;

                 }

             }

        }

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function subSubResponder($id)
    {

       $firstRespondersObj  = CaseResponder::where("sub_sub_category",'=',$id)
                                                ->select('first_responder')->first();

        $secondRespondersObj = CaseResponder::where("sub_sub_category",'=',$id)
                                                ->select('second_responder')->first();

        $thirdRespondersObj  = CaseResponder::where("sub_sub_category",'=',$id)
                                                ->select('third_responder')->first();

        $response            = array();

        if (sizeof($firstRespondersObj) > 0) {
            $firstResponders  = explode(",",$firstRespondersObj->first_responder);

                if ($firstRespondersObj->first_responder > 0) {

                           foreach ($firstResponders as $firstResponder) {

                             $user = \DB::table('users')
                                        ->where('id','=',$firstResponder)
                                        ->select(\DB::raw(
                                                    "
                                                    id,
                                                    (select CONCAT(name, ' ',surname) ) as firstResponder

                                                    "
                                                      )
                                                )->first();

                            $response[] = $user;

                            }

                }

        }

        if (sizeof($secondRespondersObj) > 0) {

            $secondResponders = explode(",",$secondRespondersObj->second_responder);

            if ($secondRespondersObj->second_responder > 0) {

                foreach ($secondResponders as $secondResponder) {

                     $user = \DB::table('users')
                                ->where('id','=',$secondResponder)
                                ->select(\DB::raw(
                                            "
                                            id,
                                            (select CONCAT(name, ' ',surname) ) as secondResponder

                                            "
                                              )
                                        )->first();

                    $response[] = $user;

                 }

            }

        }

        if (sizeof($thirdRespondersObj) > 0) {

            $thirdResponders  = explode(",",$thirdRespondersObj->third_responder);

            if ($thirdRespondersObj->third_responder > 0) {

                 foreach ($thirdResponders as $thirdResponder) {

                     $user = \DB::table('users')
                                ->where('id','=',$thirdResponder)
                                ->select(\DB::raw(
                                            "
                                            id,
                                            (select CONCAT(name, ' ',surname) ) as thirdResponder

                                            "
                                              )
                                        )->first();

                    $response[] = $user;

                 }

             }

        }

        return $response;


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
