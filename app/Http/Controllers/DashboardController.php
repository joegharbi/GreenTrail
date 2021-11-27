<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    //
    public function viewDashboard()
    {
        
        $u_id = Auth::user()->id;
        $calendars = \App\Models\Calendar::where('user_id', $u_id)
                                        ->where('rdate', '>=', DB::raw('CURRENT_TIMESTAMP()'))
                                        ->orderBy('rdate', 'ASC')
                                        ->take(10)
                                        ->get();
        
        $histories = \App\Models\History::where('user_id', $u_id)
                                        ->orderBy('created_at', 'desc')
                                        ->take(10)
                                        ->get();

        $co2_saved = \App\Models\History::where('user_id', $u_id)
                                        ->sum('reduced_emission');
    
        return view("dashboard")->with(["calendars" => $calendars])->with(["histories" => $histories])->with(["co2_saved" => $co2_saved]);
    }
}
