<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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

Route::get('/about-us', function () {
    return view('pages.about',[
    'page_name' => 'About us page',
    'page_description' => 'Description will be her '
    ]);
    // return 'green trail';
})->name("about-us");

//Route::get('/logout',function () {
//    //logout user
//    auth()->logout();
//    // redirect to homepage
//    return redirect('/');
//})->name("logout");

//(URI , view , Array of data )
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

// 14-11-2021
// Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/history', [HistoryController::class, 'show']);
// Route::get('/contact', [ContactController::class, 'show']);
