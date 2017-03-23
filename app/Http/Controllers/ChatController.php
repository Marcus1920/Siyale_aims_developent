<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\MyEventNameHere;
use App\Message;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $request->session()->all();
        return $data ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function postChat(Request $request)
    {
        $data =  array (

                'type'    => 'chat',
                'message' => $request['messageChat'],
                'author'  =>  \Auth::user()->name .' '.\Auth::user()->surname,
                'dest'    => $request['to'],
                'origin'  =>  \Auth::user()->id
        );

        event(new MyEventNameHere($data));

        $message          = new Message();
        $message->from    = \Auth::user()->id;
        $message->to      = $request['to'];
        $message->message = $request['messageChat'];
        $message->active  = 1;
        $message->online  = 1;
        $message->save();

        $response['result'] = "success";
        $response['dest']   =  $request['to'];

        return $response;

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
