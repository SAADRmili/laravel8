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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/courses', 'App\Http\Controllers\CoursesController@index')->name('courses.index');

Route::group(['auth:sanctum', 'verified'], function () {

    Route::get('/course/{id}', 'App\Http\Controllers\CoursesController@show')->name('courses.show');
    Route::post('/toggleProgress', 'App\Http\Controllers\CoursesController@toggleProgress')->name('courses.toggleProgress');
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('/courses', 'App\Http\Controllers\CoursesController@store');
});
