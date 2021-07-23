<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CreateStudentAccountController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\ListingPostController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\listingStudentController;

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

//login

// Auth::routes(['verify' => true]);

// dashboard
// Route for the "dashboard" function of the "DashboardController" controller
Route::get('dashboard', [DashboardController::class, "index"])->name('dashboard-index');
Route::post('dashboard', [DashboardController::class, "post"])->name('dashboard-post');
Route::get('/dashboard/{id}', [listingStudentController::class, 'showTable'])->name('dashboard-formation');

//Auth::routes();


// Route for the "ListingPost" function of the "ListingPostController" controller

Route::get('/listingPosts',[ListingPostController::class,'listingPost']);
Route::delete('/listingPosts/{id}',[ListingPostController::class,'deletePost'])->name('listingPosts.delete');
Route::post('/listingPosts/{id}',[ListingPostController::class,'updatePost'])->name('listingPosts.update');


// Route for the "addoffer" function of the "ListingPostController" controller
Route::post('listingPosts',[ListingPostController::class,'addoffer'])->name('post');



/* ----- Route for functions of the "CompanyController" ----- */

Route::resource('enterprises', EnterpriseController::class);

/* ---------------------------------------------------------- */

Route::post('/student/create-profil', [EnterpriseController::class, 'CreateProfil']);

// return modal view of createStudentAccount


Route::get('/enterprises/{id}/follow-up', [FollowUpController::class, 'index']);

// route for profil creation and save
Route::get('/student/create-profil', [ProfilController::class,'CreateProfil']);
Route::post('/saveprofil', [ProfilController::class, 'SaveProfil']);

// route for showing profil

Route::get('/student/profil', [ProfilController::class,'ShowProfil']);

// route for add student and redirect to createStudentAccount
Route::get('/createStudentAccount', function () {
    return view('/adviser/createStudentAccount');
});

// create new student in database
Route::post('/createStudentAccount', [CreateStudentAccountController::class, 'createStudent']);

// send email
Route::get('send-mail', function () {

    $details = [
        'title' => 'Take a look of your new profil on Kinder.nc',
        'body' => 'kndrx.github.io'
    ];

    \Mail::to('francinekendrick@gmail.com')->send(new \App\Mail\MyTestMail($details));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["verified"]);
