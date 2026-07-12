<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard');
        })->name('dashboard.Students');

        Route::group(['namespace' => 'App\Http\Controllers\Students\dashboard'], function () {
            Route::resource('student_exams', 'ExamsController');
            Route::resource('profile-student', 'ProfileController');

            // ==================== واجبات الطالب (Student Homework) ====================
            Route::get('homework', 'StudentHomeworkController@index')->name('student.homework.index');
            Route::get('homework/{id}', 'StudentHomeworkController@show')->name('student.homework.show');
            Route::get('homework_download/{filename}', 'StudentHomeworkController@download')->name('student.homework.download');
        });

        // ==================== لوحة الإعلانات (Announcements Board) ====================
        Route::get('/student/announcements', function () {
            $announcements = \App\Models\Announcement::with('creator')
                ->published()
                ->forAudience('students')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('pages.Announcements.role_view', compact('announcements'));
        })->name('student.announcements');
    }
);
