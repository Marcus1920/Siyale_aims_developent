<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseFile;
use App\CaseOwner;
use App\CaseActivity;
use App\User;

class CaseFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id,$name)
    {
        $file = CaseFile::where('case_id','=',$id)
                            ->where('file','=',$name)->first();

        return [$file->file_note];
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

        //tutsnare.com/upload-files-in-laravel/
        //laravel-recipes.com/recipes/147/creating-a-directory
        //github.com/Studio-42/elFinder/wiki/Client-configuration-options#uiOptions
        $destinationFolder = 'files/case_'.$request['caseID'];

        if(!\File::exists($destinationFolder)) {
             $createDir         = \File::makeDirectory($destinationFolder,0777,true);
        }

        $fileName          = $request->file('caseFile')->getClientOriginalName();
        $fileFullPath      = $destinationFolder.'/'.$fileName;

        if(!\File::exists($fileFullPath)) {

            $request->file('caseFile')->move($destinationFolder,$fileName);
            $caseOwners = CaseOwner::where('case_id','=',$request['caseID'])->get();
            $author     = User::find($request['uid']);

            $caseFile           = new CaseFile();
            $caseFile->file     = $fileName;
            $caseFile->img_url  = $fileFullPath;
            $caseFile->user     = $request['uid'];
            $caseFile->case_id  = $request['caseID'];
            $caseFile->file_note = $request['fileNote'];
            $caseFile->save();

            $caseActivity              = New CaseActivity();
            $caseActivity->case_id      = $request['caseID'];
            $caseActivity->user        = $request['uid'];
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "New Case File Added by ".$author->name ." ".$author->surname;
            $caseActivity->save();

            foreach ($caseOwners as $caseOwner) {

                $user = User::find($caseOwner->user);

                $data = array(
                                'name'          => $user->name,
                                'caseID'        => $request['caseID'],
                                'caseNote'      => $fileName,
                                'caseFileDesc'  =>  $request['fileNote'],
                                'author'   => $author->name .' '.$author->surname
                            );

                \Mail::send('casefiles.email',$data, function($message) use ($user)
                {
                    $message->from('info@siyaleader.net', 'Siyaleader');
                    $message->to($user->email)->subject("Siyaleader Notification - New Case File Uploaded: ");

                });

            }

             return "ok";


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
