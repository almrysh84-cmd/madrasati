<?php

use App\Models\Student;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            $sons = Student::where('parent_id', auth()->user()->id)->get();
            return view('pages.parents.dashboard', compact('sons'));
        })->name('dashboard.parents');


        Route::group(['namespace' => 'App\Http\Controllers\Parents\dashboard'], function () {
            Route::get('children', 'ChildrenController@index')->name('sons.index');
            Route::get('results/{id}', 'ChildrenController@results')->name('sons.results');
            Route::get('attendances', 'ChildrenController@attendances')->name('sons.attendances');
            Route::post('attendances', 'ChildrenController@attendanceSearch')->name('sons.attendance.search');

            Route::get('fees', 'ChildrenController@fees')->name('sons.fees');
            Route::get('receipt/{id}', 'ChildrenController@receiptStudent')->name('sons.receipt');
            Route::get('profile/parent', 'ChildrenController@profile')->name('profile.show.parent');
            Route::post('profile/parent/{id}', 'ChildrenController@update')->name('profile.update.parent');

            // ==================== الرسائل (Messaging) ====================
            Route::get('messages', [\App\Http\Controllers\Parents\dashboard\MessagesController::class, 'index'])->name('parent.messages.index');
            Route::get('messages/{teacherId}', [\App\Http\Controllers\Parents\dashboard\MessagesController::class, 'show'])->name('parent.messages.show');
            Route::post('messages/{teacherId}', [\App\Http\Controllers\Parents\dashboard\MessagesController::class, 'store'])->name('parent.messages.store');
        });

        // ==================== لوحة الإعلانات (Announcements Board) ====================
        Route::get('/parent/announcements', function () {
            $announcements = \App\Models\Announcement::with('creator')
                ->published()
                ->forAudience('parents')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('pages.Announcements.role_view', compact('announcements'));
        })->name('parent.announcements');

        // ==================== الإشعارات (Notifications) ====================
        Route::get('/parent/notifications', 'App\Http\Controllers\Notification\NotificationController@index')->name('parent.notifications.index');
        Route::post('/parent/notifications/{id}/mark-as-read', 'App\Http\Controllers\Notification\NotificationController@markAsRead')->name('parent.notifications.markAsRead');
        Route::post('/parent/notifications/mark-all-as-read', 'App\Http\Controllers\Notification\NotificationController@markAllAsRead')->name('parent.notifications.markAllAsRead');
        Route::get('/parent/notifications/unread-count', 'App\Http\Controllers\Notification\NotificationController@unreadCount')->name('parent.notifications.unreadCount');
    }
);
