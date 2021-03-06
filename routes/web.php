<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChosenTransportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', 'App\Http\Controllers\DashboardController@viewDashboard')
    ->name('dashboard');

// ---------------------------------------------------------
Route::get('/', function () {
    return view('pages.welcome');
})->name("home");

Route::get('/suggest', function (Request $request) {
    return view('pages.suggest',[
        'from_lat' => $request->input('from_lat') ?? null,
        'from_lng' => $request->input('from_lng') ?? null,
        'to_lat' => $request->input('to_lat') ?? null,
        'to_lng' => $request->input('to_lng') ?? null
    ]);
})->name("suggest");

Route::get('/bubi', function (Request $request) {
    return view('pages.bubi',[
        'lat' => $request->input('lat') ?? null,
        'lng' => $request->input('lng') ?? null,
        'n' => $request->input('n') ?? null
    ]);
})->name("bubi");

Route::get('/about-us', function () {
    return view('pages.about',[
    'page_name' => 'About us page',
    'page_description' => 'Description will be her '
    ]);
})->name("about-us");

Route::view('contact', 'pages/contact',[
    'page_name' => 'contact us page',
    'page_description' => 'Description will be her '
])->name("contact");


Route::group(['prefix' => 'api'], function() {
    Route::get('/',function() {
        return 'HERE API Connection';
    })->name('api');

    Route::get('key',function() {
        return File::get(resource_path('api/api_key.txt'));
    })->name('api/key');

    function send_api_request(Request $request, $endpoint) {
        $params = $request->all();
        $client = new \GuzzleHttp\Client();
        try {
            $params['apiKey'] = trim(File::get(resource_path('api/api_key.txt')));
            $response = $client->request('GET', $endpoint, ['query' => $params]);

            return $response->getBody();
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    Route::get('/autocomplete', function(Request $request) {
        return send_api_request($request, 'https://autocomplete.search.hereapi.com/v1/autocomplete');
    });

    Route::get('/revgeocode', function(Request $request) {
        return send_api_request($request, 'https://revgeocode.search.hereapi.com/v1/revgeocode');
    });

    Route::get('/geocode', function(Request $request) {
        return send_api_request($request, 'https://geocode.search.hereapi.com/v1/geocode');
    });
});


// MK
Route::view('calendar', 'pages/calendar/calendar_dashboard',[
    'page_name' => 'Calendar page',
    'page_descrption' => 'Scheduling a rout'
])->name("calendar_dashboard");

Route::post('/calendar/post', 'App\Http\Controllers\CalendarController@viewDates');
Route::get('/calendar/post_schedule', 'App\Http\Controllers\CalendarController@saveDates');
Route::get('/calendar/schedules', 'App\Http\Controllers\CalendarController@viewSchedules');
Route::get('/calendar/schedules/delete/{id}', 'App\Http\Controllers\CalendarController@deleteSchedule');
Route::GET('/calendar/checkEvents', 'App\Http\Controllers\CalendarController@checkNearEvents');


// History
Route::get('/history', 'App\Http\Controllers\HistoryController@viewHistory')->name('history');


Route::post('/chosentransport', [ChosenTransportController::class, 'store'])->name('chosentransport');
