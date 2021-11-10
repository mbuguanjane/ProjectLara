<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApplicationController;

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

Route::get('/', [PageController::class,'index']);

Route::get('/Studentdetails', function(){
    return view('pages.StudentDetails');
});
//searching
Route::get('findinternship',[App\Http\Controllers\InternshipController::class,'search']);
//end searching 
Route::get('/StudentDash', [ApplicationController::class,'index']);

Route::get('/index', [PageController::class,'index']);
Route::get('/about', [PageController::class,'about']);
Route::get('/contact', [PageController::class,'contact']);
Route::get('/job_listing',[App\Http\Controllers\InternshipController::class, 'internshipsReturn']);
Route::get('/IntershipSearch',[App\Http\Controllers\InternshipController::class,'IntershipSearch']);
Route::get('/Dashboard',[App\Http\Controllers\InternshipController::class,'Dashboard']);
Route::get('/Applynow/{id}',[App\Http\Controllers\InternshipController::class,'Applynow']);

//dashboard
Route::resource('internships',InternshipController::class);
Route::get('/Dashboard', [App\Http\Controllers\InternshipController::class, 'Dashboard']);
Route::get('/users', [App\Http\Controllers\InternshipController::class, 'Dashboard']);
Route::get('/Internship', [App\Http\Controllers\InternshipController::class, 'Dashboard']);
Route::get('/profile',[App\Http\Controllers\InternshipController::class, 'Dashboard']);
//end dashboard

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('Applications',ApplicationController::class);
Route::resource('internships',InternshipController::class);
Route::resource('students',StudentsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');