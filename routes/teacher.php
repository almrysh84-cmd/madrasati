<?php

use App\Models\Teacher;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();

            return view('pages.Teachers.dashboard.dashboard', $data);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Teachers\dashboard'], function () {
            //==============================students============================
            Route::get('student', 'StudentController@index')->name('student.index');
            Route::get('sections', 'StudentController@sections')->name('sections');
            Route::post('attendance', 'StudentController@attendance')->name('attendance');

            Route::get('attendance_report', 'StudentController@attendanceReport')->name('attendance.report');
            Route::post('attendance_report', 'StudentController@attendanceSearch')->name('attendance.search');
            Route::resource('quizzes', 'QuizzController');
            Route::resource('questions', 'QuestionController')->except(['index', 'create']);
            Route::resource('online_zoom_classes', 'OnlineZoomClassesController')->except(['show', 'edit', 'update']);

            Route::get('/indirect', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
            Route::post('/indirect', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');

            Route::get('profile', 'ProfileController@index')->name('profile.show');
            Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');

            Route::get('student_quizze/{id}', 'QuizzController@student_quizze')->name('student.quizze');
            Route::post('repeat_quizze', 'QuizzController@repeat_quizze')->name('repeat.quizze');

            // ==================== الواجبات (Homework) ====================
            Route::resource('homework', 'HomeworkController');
            Route::post('homework_question', 'HomeworkController@storeQuestion')->name('homework.question.store');
            Route::get('homework_question/{id}', 'HomeworkController@destroyQuestion')->name('homework.question.destroy');
            Route::get('homework_download/{filename}', 'HomeworkController@download')->name('homework.download');

            // ==================== التقديرات (Student Grades) ====================
            Route::get('grades', 'GradeController@index')->name('grades.index');
            Route::post('grades', 'GradeController@store')->name('grades.store');
            Route::get('grades_report', 'GradeController@report')->name('grades.report');
            Route::post('grades_report', 'GradeController@search')->name('grades.search');
            Route::get('get_students', 'GradeController@getStudents')->name('grades.getStudents');

            // ==================== بنك الأسئلة المركزي (Question Bank) ====================
            Route::resource('question_bank', 'QuestionBankController');
            Route::get('question_bank_export', 'QuestionBankController@export')->name('question_bank.export');
            Route::post('question_bank_import', 'QuestionBankController@import')->name('question_bank.import');
            Route::get('question_bank_search', 'QuestionBankController@search')->name('question_bank.search');

            // ==================== إعلانات المعلم للطلاب ====================
            Route::get('my_announcements', 'TeacherAnnouncementController@index')->name('teacher.announcements.index');
            Route::get('my_announcements/create', 'TeacherAnnouncementController@create')->name('teacher.announcements.create');
            Route::post('my_announcements', 'TeacherAnnouncementController@store')->name('teacher.announcements.store');
            Route::delete('my_announcements/{id}', 'TeacherAnnouncementController@destroy')->name('teacher.announcements.destroy');

            // ==================== الرسائل (Messaging with parents) ====================
            Route::get('messages', 'TeacherMessagesController@index')->name('teacher.messages.index');
            Route::get('messages/{parentId}', 'TeacherMessagesController@show')->name('teacher.messages.show');
            Route::post('messages/{parentId}', 'TeacherMessagesController@store')->name('teacher.messages.store');
        });

        // ==================== لوحة الإعلانات (Announcements Board) ====================
        Route::get('/teacher/announcements', function () {
            $announcements = \App\Models\Announcement::with('creator')
                ->published()
                ->forAudience('teachers')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('pages.Announcements.role_view', compact('announcements'));
        })->name('teacher.announcements');

        // ==================== الإشعارات (Notifications) ====================
        Route::get('/teacher/notifications', 'App\Http\Controllers\Notification\NotificationController@index')->name('teacher.notifications.index');
        Route::post('/teacher/notifications/{id}/mark-as-read', 'App\Http\Controllers\Notification\NotificationController@markAsRead')->name('teacher.notifications.markAsRead');
        Route::post('/teacher/notifications/mark-all-as-read', 'App\Http\Controllers\Notification\NotificationController@markAllAsRead')->name('teacher.notifications.markAllAsRead');
        Route::get('/teacher/notifications/unread-count', 'App\Http\Controllers\Notification\NotificationController@unreadCount')->name('teacher.notifications.unreadCount');
    }
);
