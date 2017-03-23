<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddressBookRequest;
use App\Http\Controllers\Controller;
use App\addressbook;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $addresses = addressbook::select(
                                            array(
                                                    'id',
                                                    'first_name',
                                                    'surname',
                                                    'cellphone',
                                                    'email',
                                                    'created_at'
                                                ))->where('user','=',$id);
        return \Datatables::of($addresses)
                            ->addColumn('actions',''
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
    public function store(AddressBookRequest $request)
    {

         $addressbook                   = new addressbook();
         $addressbook->first_name       = $request['FirstName'];
         $addressbook->surname          = $request['Surname'];
         $addressbook->email            = $request['email'];
         $addressbook->cellphone        = $request['cellphone'];
         $addressbook->user             = $request['uid'];
         $addressbook->relationship     = $request['relationship'];
         $addressbook->active           = 1;
         $addressbook->save();

        \Session::flash('successAddressBook', $request['FirstName'].' '.$request['Surname'].' has been successfully added!');
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

        $searchString = \Input::get('q');
        $addressbookContacts     = \DB::table('addressbook')
                        ->where('user','=',\Auth::user()->id)
                        ->whereRaw("CONCAT(`first_name`, ' ', `surname`, ' ', `email`) LIKE '%{$searchString}%'")
                        ->select(\DB::raw('*'))
                        ->get();

        $data = array();

        if(count($addressbookContacts) > 0)
        {

           foreach ($addressbookContacts as $addressbookContact) {
           $data[]= array("name"=>"{$addressbookContact->first_name} {$addressbookContact->surname} <{$addressbookContact->email}","id" =>"{$addressbookContact->email}","first_name" =>"{$addressbookContact->first_name}","surname" =>"{$addressbookContact->surname}","cellphone" =>"{$addressbookContact->cellphone}","email" => "{$addressbookContact->email}","userId" => "{$addressbookContact->id}","addressbook" => "1");
           }


        }

         $usersContacts   = \DB::table('users')
                            ->join('positions','users.position','=','positions.id')
                            ->whereRaw("CONCAT(`users`.`name`, ' ', `users`.`surname`, ' ', `users`.`email`,`positions`.`name`) LIKE '%{$searchString}%'")
                            ->select(array('users.id','users.name as name','users.surname as surname','users.email as username','users.cellphone as cellphone','positions.name as position'))
                            ->get();



        if(count($usersContacts) > 0)

        {

           foreach ($usersContacts as $usersContact) {
           $data[] = array("name"=>"{$usersContact->name} {$usersContact->surname} << {$usersContact->position}","id" =>"{$usersContact->username}","first_name" => "{$usersContact->name}","surname" => "{$usersContact->surname}","cellphone" => "{$usersContact->cellphone}","email" => "{$usersContact->username}","userId" => "{$usersContact->id}","addressbook" => "0");
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
