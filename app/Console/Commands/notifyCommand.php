<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CaseReport;
use App\CaseOwner;
use App\CaseResponder;
use App\User;

class notifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-us';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify inactive cases.';

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
    public function fire()
    {

        \Log::info("Elie Ishimwe");
        $nowDate = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        //$endDate = \Carbon\Carbon::now('Africa/Johannesburg')->addMinutes(5);

        $cases   = CaseReport::where('accepted_at', '=' ,'0000-00-00 00:00:00')
                                ->where('referred_at','<>','0000-00-00 00:00:00')
                                ->get();

        \Log::info("Cases:");
        \Log::info($cases);


        foreach ($cases as $case) {

            if ($case->sub_sub_category > 0) {

               $firstRespondersObj  = CaseResponder::where("sub_sub_category",'=',$case->sub_sub_category)
                                                        ->select('firstResponder')->get();
                \Log::info("First Responders");
                \Log::info($firstRespondersObj);
                \Log::info(sizeof($firstRespondersObj));

               $secondRespondersObj = CaseResponder::where("sub_sub_category",'=',$case->sub_sub_category)
                                                ->select('secondResponder')->get();

                \Log::info("Second Responders");
                \Log::info($secondRespondersObj);
                \Log::info(sizeof($secondRespondersObj));


               if (sizeof($firstRespondersObj) > 0) {

                    $firstResponders  = explode(",",$firstRespondersObj->firstResponder);

                    foreach ($firstResponders as $firstResponder) {

                         $firstResponderUser = User::find($firstResponder);

                         $data = array(
                                        'name'   =>$firstResponderUser->name,
                                        'caseID' =>$case->id,
                                        'caseDesc' => $case->description,
                                        'caseReporter' => $case->description,
                                    );

                        \Mail::send('emails.firstNotification',$data, function($message) use ($firstResponderUser) {
                            $message->from('info@siyaleader.net', 'Siyaleader');
                            $message->to($firstResponderUser->username)->subject("Siyaleader Notification - New Case Notification:");

                        });


                    }

               }

               /* if (sizeof($secondRespondersObj) > 0) {

                    $secondResponders  = explode(",",$secondRespondersObj->secondResponder);

                    foreach ($secondResponders as $secondResponder) {

                        $secondResponderUser = User::find($secondResponder);
                        $caseOwner           = new CaseOwner();
                        $caseOwner->user     = $secondResponder ;
                        $caseOwner->caseId   = $case->id;
                        $caseOwner->type     = 2;
                        $caseOwner->active   = 1;
                        $caseOwner->save();

                         $data = array(
                                        'name'   =>$secondResponderUser->name,
                                        'caseID' =>$case->id,
                                        'caseDesc' => $case->description,
                                        'caseReporter' => $case->description,
                                    );

                        \Mail::send('emails.responder',$data, function($message) use ($secondResponderUser) {
                            $message->from('info@siyaleader.net', 'Siyaleader');
                            $message->to($secondResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                        });


                    }

               }*/


            }


        }


    }
}
