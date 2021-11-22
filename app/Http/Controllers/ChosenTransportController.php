<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\History;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChosenTransportController extends Controller
{
    public function store(Request $post)
    {
        DB::table('histories')->insert([
            'user_id' => $post->input('user_id'),
            'source' => $post->input('source'),
            'destination' => $post->input('destination'),
            'chosen_transportation' => $post->input('chosen_transportation'),
            'reduced_emission' => $post->input('reduced_emission'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
