<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseNote;
use App\CaseOwner;
use App\CaseActivity;
use App\User;

class CaseNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

        $caseNotes = \DB::table('cases_notes')->where('case_id','=',$id)
                        ->join('users','users.id','=','cases_notes.user')
                        ->select(array('cases_notes.id','cases_notes.case_id','users.name as user','cases_notes.note as note','cases_notes.active','cases_notes.created_at as created_at'));

        return \Datatables::of($caseNotes)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>'
                                       )
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
    public function store(Request $request)
    {


        $caseOwners = CaseOwner::where('case_id','=',$request['caseID'])->get();
        $author     = User::find($request['uid']);

        $caseNote         = new CaseNote();
        $caseNote->note   = $request['caseNote'];
        $caseNote->user   = $request['uid'];
        $caseNote->case_id = $request['caseID'];
        $caseNote->save();

        $caseActivity              = New CaseActivity();
        $caseActivity->case_id     = $request['caseID'];
        $caseActivity->user        = $request['uid'];
        $caseActivity->addressbook = 0;
        $caseActivity->note        = "New Case Noted Added by ".$author->name ." ".$author->surname;
        $caseActivity->save();



        foreach ($caseOwners as $caseOwner) {

            $user = User::find($caseOwner->user);

            $data = array(
                            'name'     => $user->name,
                            'caseID'   => $request['caseID'],
                            'caseNote' => $request['caseNote'],
                            'author'   => $author->name .' '.$author->surname
                        );

            \Mail::send('casenotes.email',$data, function($message) use ($user)
            {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($user->email)->subject("Siyaleader Notification - New Case Note: ");

            });

        }

        return "ok";
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
