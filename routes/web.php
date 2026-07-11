<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('selection');


Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');

    Route::post('/login', 'LoginController@login')->name('login');

    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});
 
//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {
        //==============================dashboard============================
        //Route::get('/', 'App\Http\Controllers\HomeController@index')->name('dashboard');
        Route::get('/dashboard', 'App\Http\Controllers\Dashboard\DashboardController@index')->name('dashboard');

        //==============================Chart Data API============================
        Route::get('/dashboard/chart-data', 'App\Http\Controllers\Dashboard\DashboardController@chartData')->name('dashboard.chartData');

        //==============================Notifications============================
        Route::group(['namespace' => 'App\Http\Controllers\Notification'], function () {
            Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
            Route::post('/notifications/{id}/mark-as-read', 'NotificationController@markAsRead')->name('notifications.markAsRead');
            Route::post('/notifications/mark-all-as-read', 'NotificationController@markAllAsRead')->name('notifications.markAllAsRead');
            Route::delete('/notifications/{id}', 'NotificationController@destroy')->name('notifications.destroy');
            Route::get('/notifications/unread-count', 'NotificationController@unreadCount')->name('notifications.unreadCount');
        });

        //==============================Activity Log============================
        Route::group(['namespace' => 'App\Http\Controllers\ActivityLog'], function () {
            Route::get('/activity-log', 'ActivityLogController@index')->name('activitylog.index');
            Route::delete('/activity-log/{id}', 'ActivityLogController@destroy')->name('activitylog.destroy');
            Route::post('/activity-log/clear-all', 'ActivityLogController@clearAll')->name('activitylog.clearAll');
        });

        //==============================Grades============================
        Route::group(['namespace' => 'App\Http\Controllers\Grades'], function () {
            Route::resource('Grades', 'GradeController');
        });

        //==============================Classrooms============================
        Route::group(['namespace' => 'App\Http\Controllers\Classrooms'], function () {
            Route::resource('Classrooms', 'ClassroomController');

            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        });

        //==============================Sections============================
        Route::group(['namespace' => 'App\Http\Controllers\Sections'], function () {

            Route::resource('Sections', 'SectionController');

            Route::get('/classes/{id}', 'SectionController@getclasses');
        });


        //==============================Parents============================
        Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

        //==============================Teachers============================
        Route::group(['namespace' => 'App\Http\Controllers\Teachers'], function () {

            Route::resource('Teachers', 'TeacherController');
        });
        //==============================Students============================
        Route::group(['namespace' => 'App\Http\Controllers\Students'], function () {

            Route::resource('Students', 'StudentController');
            Route::get('indirect_admin', 'OnlineClasseController@indirectCreate')->name('indirect.create');
            Route::post('indirect_admin', 'OnlineClasseController@storeIndirect')->name('indirect.store');
            Route::resource('online_classes', 'OnlineClasseController');
            Route::resource('Promotion', 'PromotionController');
            Route::resource('Graduated', 'GraduatedController');
            Route::resource('Fees', 'FeesController');
            Route::resource('Fees_Invoices', 'FeesInvoicesController')->except(['create']);
            Route::resource('receipt_students', 'ReceiptStudentsController');
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::resource('Payment_students', 'PaymentController');
            Route::resource('Attendance', 'AttendanceController')->except(['create']);

            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::resource('library', 'LibraryController');



            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        });

        //==============================Subjects============================
        Route::group(['namespace' => 'App\Http\Controllers\Subjects'], function () {
            Route::resource('subjects', 'SubjectController');
        });

        //==============================Quizzes============================
        Route::group(['namespace' => 'App\Http\Controllers\Quizzes'], function () {
            Route::resource('Quizzes', 'QuizzController');
        });

        //==============================questions============================
        Route::group(['namespace' => 'App\Http\Controllers\Questions'], function () {
            Route::resource('Questions', 'QuestionController');
        });

        //==============================Setting============================
        Route::resource('settings', 'App\Http\Controllers\SettingController');

        //==============================Excel استيراد وتصدير============================
        Route::group(['namespace' => 'App\Http\Controllers\Excel'], function () {
            Route::get('excel', 'ExcelController@index')->name('excel.index');
            Route::post('excel/import/students', 'ExcelController@importStudents')->name('excel.importStudents');
            Route::post('excel/import/teachers', 'ExcelController@importTeachers')->name('excel.importTeachers');
            Route::post('excel/import/grades', 'ExcelController@importGrades')->name('excel.importGrades');
            Route::post('excel/import/attendance', 'ExcelController@importAttendance')->name('excel.importAttendance');
            Route::get('excel/export/students', 'ExcelController@exportStudents')->name('excel.exportStudents');
            Route::get('excel/export/teachers', 'ExcelController@exportTeachers')->name('excel.exportTeachers');
            Route::get('excel/export/grades', 'ExcelController@exportGrades')->name('excel.exportGrades');
            Route::get('excel/export/attendance', 'ExcelController@exportAttendance')->name('excel.exportAttendance');
            Route::get('excel/errors/{filename}', 'ExcelController@downloadErrors')->name('excel.downloadErrors');
        });

        //==============================PDF طباعة التقارير============================
        Route::group(['namespace' => 'App\Http\Controllers\Pdf'], function () {
            Route::get('pdf/class-roster/{section_id}', 'PdfController@classRoster')->name('pdf.classRoster');
            Route::get('pdf/final-results/{student_id}', 'PdfController@finalResults')->name('pdf.finalResults');
            Route::get('pdf/fee-invoice/{invoice_id}', 'PdfController@feeInvoice')->name('pdf.feeInvoice');
            Route::get('pdf/receipt/{receipt_id}', 'PdfController@receipt')->name('pdf.receipt');
            Route::get('pdf/attendance-matrix', 'PdfController@attendanceMatrix')->name('pdf.attendanceMatrix');
        });
    }
);