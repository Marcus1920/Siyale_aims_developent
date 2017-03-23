<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\UserRole;
use App\UserStatus;
use App\CaseReport;
use App\CaseSource;
use App\Events\MyEventNameHere;

class AssignCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-case';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign cases';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $userRole  = UserRole::where('id','=',2)->first();

        $users     = User::where('availability', '=' ,1)
                            ->where('role','=',$userRole->id)
                            ->get();

        $caseSource      = CaseSource::where('name','=','sms')->first();
        $noLoggedInUsers = sizeof($users);



        if ($noLoggedInUsers > 0) {

            foreach ($users as $user) {


               $myAssignedCases = CaseReport::where('source','=',$caseSource->id)
                                    ->where('agent','=',$user->id)
                                    ->where('status','=',1)
                                    ->where('busy','=', 1)
                                    ->first();

                $noAssignedCases = sizeof($myAssignedCases);

                if ($noAssignedCases < 5) {

                      $unassignedCases = CaseReport::where('source','=',$caseSource->id)
                                        ->where('busy','=',0)
                                        ->where('agent','=',0)
                                        ->where('status','=',1)
                                        ->orderBy('created_at','asc')
                                        ->first();

                      $noUnAssignedCases = sizeof($unassignedCases);


                      if ($noUnAssignedCases > 0) {

                            $unassignedCases->agent = $user->id;
                            $unassignedCases->user  = $user->id;
                            $unassignedCases->busy  = 1;
                            $unassignedCases->save();

                            $data =  array (

                                'userID'  => $user->id,
                                'type'    => 'assignCases',
                                'caseID'  => $unassignedCases->id,
                            );

                            event(new MyEventNameHere($data));

                      }




                  }



            }



        }


    }
}
