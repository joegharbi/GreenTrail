<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\History;
class HistoryController extends Controller
{
    public function show()
    {
        return "Hello from history";
    }
}
