<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Workflow;

class WorkflowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $workflows = \DB::table('workflows')
                ->where('sub_category_id','=',$id)
                ->select(
                            \DB::raw("
                                        workflows.id,
                                        workflows.name,
                                        workflows.sub_category_id,
                                        workflows.order,
                                        workflows.created_by,
                                        workflows.updated_by,
                                        workflows.active
                                    "
                                        )
                        )
                ->groupBy('workflows.id');

        return \Datatables::of($workflows)
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveWorkFlowOrder(Request $request)
    {

        $response            = array();
        $workflow            = Workflow::find($request['id']);
        $workflow->order     = $request['order'];
        $workflow->save();
        $response['error']   =  FALSE;
        $response['message'] = 'Workflow flow saved successfully!!';

        return \Response::json($response,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $response                  = array();
        $workflow                  = new Workflow();
        $workflow->name            = $request['name'];
        $workflow->sub_category_id = $request['subCatID'];
        $workflow->save();
        $response['message']       = 'ok';
        $response['subCatID']      = $request['subCatID'];
        $response['error']         = FALSE;

        return \Response::json($response,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeWorkFlow(Request $request)
    {
        $response = array();

        foreach ($request['arr'] as $value) {

            $workFlow = Workflow::find($value);
            $workFlow->delete();

        }

        $response["message"]   = "Workflow Deleted!";
        $response["error"]     = FALSE;

        return \Response::json($response,201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
