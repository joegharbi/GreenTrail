<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use DB;
use DateTime;

class CalendarController extends Controller
{
    // MK
    public function viewDates(Request $request)
    {
        date_default_timezone_set('Europe/Budapest');

        $calendar_arr = array();
        $calendars_arr = array();

        $u_id = Auth::user()->id;
        $start = $request['start'];
        $end = $request['end'];
        
        // for query testing
        //DB::enableQueryLog();

        $calendars = \App\Models\Calendar::where('user_id', $u_id)
                                        ->where('rdate', '>=', $start)
                                        ->where('rdate', '<=', $end)
                                        ->orderBy('rdate', 'ASC')
                                        // ->where('rdate', '>=', DB::raw('CURRENT_TIMESTAMP()'))
                                        ->get();
        
        //dd(DB::getQueryLog());
        //dd($calendars);
        $dates = array();
        foreach($calendars as $calendar){
            $rdate = $calendar->rdate;
            $comments = $calendar->comments;
            $state = $calendar->state;
            
            $calendar_arr['title'] = $comments;
            $calendar_arr['start'] = $rdate;

            $d1 = strtotime($rdate.":00");
            $d2 = strtotime(date("Y-m-d H:i:s"));

            $dates[]= $d1 .' - '.$calendar->id.' - '.  date("Y-m-d H:i:s");
            if($state == "done"){
                $bgClr = '#61dcf5';//suggested
            }else if($d1>$d2){
                $bgClr = '#ffd65d';//pending
            }else{
                $bgClr = '#dbdbdb';//old
            }
            
            //if($status == 'DENIED') {$bgClr = '#ff0000';}
            //else if($status == 'APPROVED') {$bgClr = '#00cc00';}
            $calendar_arr['backgroundColor'] = $bgClr; //#7FFF00 -> green, #ff0000 red, #f39c12 -> pending 
            $calendar_arr['borderColor'] = $bgClr;
            $calendar_arr['url'] = '';

            $calendars_arr[] = $calendar_arr; 
            $calendar_arr = [];
        }

        // return $dates;
        return json_encode($calendars_arr);
    }

    public function saveDates(Request $request)
    {
        
        //DB::enableQueryLog();
        $calendar = new \App\Models\Calendar;

        $u_id = Auth::user()->id;
        $source  = $request->source;
        $destination  = $request->destination;
        $from_lat = $request->from_lat;
        $from_lng = $request->from_lng;
        $to_lat = $request->to_lat;
        $to_lng = $request->to_lng;
        $comment = $request->comment;
        $rdate  = $request->rdate;
        $rtime  = $request->rtime;
        $sch_date   = $rdate. ' '. $rtime;

        $calendar->user_id = $u_id;
        $calendar->source = $source;
        $calendar->destination = $destination;
        $calendar->from_lat = $from_lat;
        $calendar->from_lng = $from_lng;
        $calendar->to_lat = $to_lat;
        $calendar->to_lng = $to_lng;
        $calendar->comments = $comment;
        $calendar->rdate = $sch_date;
        
        $calendar->save();

        
        return view("pages/calendar/calendar_dashboard",[
            'page_name' => 'Calendar page',
            'page_descrption' => 'Scheduling a rout'
        ]);
    }

    public function viewSchedules()
    {
        
        $u_id = Auth::user()->id;
        $calendars = \App\Models\Calendar::where('user_id', $u_id)
                                        ->where('rdate', '>=', DB::raw('CURRENT_TIMESTAMP()'))
                                        ->orderBy('rdate', 'ASC')
                                        ->take(10)
                                        ->get();
        
    
        return view("pages/calendar/event_show")->with(["calendars" => $calendars]);
    }

    public function deleteSchedule($id)
    {
        
        \App\Models\Calendar::where('id', $id)->delete();
        
        return redirect("/calendar/schedules");
    }

    public function checkNearEvents()
    {

        // for query testing
        //DB::enableQueryLog();

        $u_id = Auth::user()->id;

        $calendars = \App\Models\Calendar::where('user_id', $u_id)
                                        ->whereBetween('rdate', [DB::raw('CURRENT_TIMESTAMP()'), DB::raw('ADDTIME(CURRENT_TIMESTAMP(), TIME("00:10:00"))')])
                                        ->where('state', 'pending')
                                        ->orderBy('rdate', 'asc')
                                        ->take(1)
                                        ->get();
        //dd(DB::getQueryLog());
        //dd($calendars);
        $eventsCount = $calendars->count();
      
        
        return $eventsCount;
    }
    
}

