<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\History;
use Illuminate\Support\Facades\Auth;
use DB;

class HistoryController extends Controller
{
    public function show()
    {
        return "Hello from history";
    }


    public function viewHistory()
    {
        date_default_timezone_set('Europe/Budapest');
        
        $u_id = Auth::user()->id;
        
        $histories = \App\Models\History::addSelect(DB::raw('*, `created_at` + INTERVAL 1 hour as `created_at`'))
                                        ->where('user_id', $u_id)
                                        ->orderBy('created_at', 'desc')
                                        ->take(10)
                                        ->get();

        $co2_saved = \App\Models\History::where('user_id', $u_id)
                                        ->sum('reduced_emission');
    
        // dd($histories);
        return view("pages.history.history_main")->with(["histories" => $histories])->with(["co2_saved" => $co2_saved]);
    }
}
