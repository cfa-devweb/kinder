<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\follow\ProspectController;

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('index');
});

// dashboard
// Route for the "dashboard" function of the "DashboardController" controller
Route::get('dashboard',[DashboardController::class,"index"])->name('dashboard-index');
//Auth::routes();

// Route for the "displaycompany" function of the "CompanyController" controller
Route::get('/prospect', [ProspectController::class, 'displaycompany']);

// Route for the "addcompany" function of the "CompanyController" controller
Route::post('/prospect', [ProspectController::class, 'addcompany']);


Route::get('send-mail', function () {   

    $details = [
        'title' => 'Take a look of your new profil on Kinder.nc',
        'body' => 'kndrx.github.io'
    ];
   
    \Mail::to('francinekendrick@gmail.com')->send(new \App\Mail\MyTestMail($details));


    dd("Email is Sent.");
});
