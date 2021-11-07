<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/suggest', function () {
    return view('pages.suggest');
})->name("suggest");

Route::get('/about-us', function () {
    return view('pages.about',[
    'page_name' => 'About us page',
    'page_descrption' => 'Descrbtion will be her '
    ]);
    // return 'green trail';
})->name("about-us");

//(URI , view , Array of data )
Route::view('contact', 'pages/contact',[
    'page_name' => 'contact us page',
    'page_description' => 'Description will be her '
])->name("contact");

Route::get('category/{id}', function ($id) {
    $cats = [
        '1' => 'Weather',
        '2' => 'Traffic'
           ];

    return view("pages.category",[
        'the_id' =>  $cats[$id] ?? "This id not found"
                           ]);
});
