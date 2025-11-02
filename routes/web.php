<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/school', [SchoolController::class, 'edit'])->name('school.edit');
    Route::post('/school', [SchoolController::class, 'update'])->name('school.update');

    Route::resource('/teachers', TeacherController::class);
    Route::resource('/extracurriculars', ExtracurricularController::class);
    Route::resource('/news', NewsController::class); 
});