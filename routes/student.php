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
            Route::get('my_homework', [\App\Http\Controllers\Students\dashboard\StudentHomeworkController::class, 'index'])->name('student.homework.index');
            Route::get('my_homework/{id}', [\App\Http\Controllers\Students\dashboard\StudentHomeworkController::class, 'show'])->name('student.homework.show');
            Route::get('student_homework_download/{filename}', [\App\Http\Controllers\Students\dashboard\StudentHomeworkController::class, 'download'])->name('student.homework.download');

            // ==================== المواد الدراسية (Student Subjects) ====================
            Route::get('student_subjects', [\App\Http\Controllers\Students\dashboard\StudentSubjectsController::class, 'index'])->name('student.subjects.index');
            Route::get('student_subjects/{subjectId}', [\App\Http\Controllers\Students\dashboard\StudentSubjectsController::class, 'show'])->name('student.subjects.show');
            Route::get('student_subjects/{subjectId}/messages', [\App\Http\Controllers\Students\dashboard\StudentSubjectsController::class, 'messages'])->name('student.subjects.messages');
            Route::post('student_subjects/{subjectId}/messages', [\App\Http\Controllers\Students\dashboard\StudentSubjectsController::class, 'sendMessage'])->name('student.subjects.sendMessage');
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

        // ==================== الإشعارات (Notifications) ====================
        // مسارات الإشعارات للطالب — تسمح للطالب برؤية إشعاراته وتمييزها كمقروءة
        Route::get('/student/notifications', 'App\Http\Controllers\Notification\NotificationController@index')->name('student.notifications.index');
        Route::post('/student/notifications/{id}/mark-as-read', 'App\Http\Controllers\Notification\NotificationController@markAsRead')->name('student.notifications.markAsRead');
        Route::post('/student/notifications/mark-all-as-read', 'App\Http\Controllers\Notification\NotificationController@markAllAsRead')->name('student.notifications.markAllAsRead');
        Route::get('/student/notifications/unread-count', 'App\Http\Controllers\Notification\NotificationController@unreadCount')->name('student.notifications.unreadCount');
    }
);
