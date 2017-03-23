<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CalendarEvent;
use App\MeetingAttendee;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         return view('calendar.calendar');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {




        $myMeetings = MeetingAttendee::where('phonebook','=',0)
                                        ->where('attendee','=',\Auth::user()->id)
                                        ->select('meeting')
                                        ->get();

        $myMeetingIds = array();

        foreach ($myMeetings as $myMeeting) {

            $myMeetingIds[] = $myMeeting->meeting;

        }

        $calendarMeetingsEvents = \DB::table('calendar_events')
                            ->join('calendar_events_type', 'calendar_events.event_type_id', '=', 'calendar_events_type.id')
                            ->select(
                                        \DB::raw("
                                                    calendar_events.id,
                                                    calendar_events.name,
                                                    calendar_events.start_date,
                                                    calendar_events.start_time,
                                                    calendar_events.end_date,
                                                    calendar_events.end_time,
                                                    calendar_events_type.name as event_type
                                                "

                                                )
                                    )
                            ->where('calendar_events.event_type_id','=',1)
                            ->whereIn('meeting_id',$myMeetingIds)
                            ->groupBy('calendar_events.id')
                            ->get();



        $calendarEventArray = array();
        $response           = array();

        foreach ($calendarMeetingsEvents as $calendarMeetingEvent) {

            $calendarEventArray['title'] = $calendarMeetingEvent->start_time.'-'.$calendarMeetingEvent->name;
            $calendarEventArray['start'] = $calendarMeetingEvent->start_date.' '.$calendarMeetingEvent->start_time;
            $calendarEventArray['end']   = $calendarMeetingEvent->end_date.' '.$calendarMeetingEvent->end_time;
            $response[]                  = $calendarEventArray;


        }

        return \Response::json($response);

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
