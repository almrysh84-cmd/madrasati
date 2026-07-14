<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| RESTful API Routes — v1
|--------------------------------------------------------------------------
|
| API كامل لتكاملات الجوال والتطبيقات الخارجية.
| المصادقة: Laravel Sanctum (Token-based)
| Rate Limiting: 60 req/min
|
*/

Route::prefix('v1')->middleware(['throttle:60,1'])->group(function () {

    // ===== المصادقة =====
    Route::post('/auth/login', function (Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'type'     => 'required|in:admin,teacher,student,parent',
        ]);

        $guard = $request->type === 'admin' ? 'web' : $request->type;
        $model = auth($guard)->getProvider()->getModel();

        if (auth($guard)->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth($guard)->user();
            $token = $user->createToken('api-' . $request->type)->plainTextToken;

            return response()->json([
                'success' => true,
                'token'   => $token,
                'user'    => [
                    'id'    => $user->id,
                    'name'  => $user->name ?? $user->email,
                    'email' => $user->email,
                    'type'  => $request->type,
                ],
            ]);
        }

        return response()->json(['success' => false, 'message' => 'بيانات الدخول غير صحيحة'], 401);
    })->name('api.login');

    // ===== المسارات المحمية =====
    Route::middleware('auth:sanctum')->group(function () {

        // --- الطلاب ---
        Route::get('/students', function () {
            return response()->json([
                'success' => true,
                'data' => \App\Models\Student::with(['gender', 'grade', 'classroom', 'section'])
                    ->paginate(50),
            ]);
        })->name('api.students.index');

        Route::get('/students/{id}', function ($id) {
            $student = \App\Models\Student::with(['gender', 'grade', 'classroom', 'section', 'myparent'])
                ->findOrFail($id);
            return response()->json(['success' => true, 'data' => $student]);
        })->name('api.students.show');

        // --- الحضور ---
        Route::get('/attendance', function (Request $request) {
            $request->validate([
                'student_id' => 'nullable|exists:students,id',
                'from'       => 'nullable|date',
                'to'         => 'nullable|date|after_or_equal:from',
            ]);

            $query = \App\Models\Attendance::with(['student', 'subject']);

            if ($request->student_id) $query->where('student_id', $request->student_id);
            if ($request->from) $query->where('attendence_date', '>=', $request->from);
            if ($request->to) $query->where('attendence_date', '<=', $request->to);

            return response()->json([
                'success' => true,
                'data' => $query->paginate(50),
            ]);
        })->name('api.attendance.index');

        // --- الدرجات ---
        Route::get('/grades', function (Request $request) {
            $request->validate(['student_id' => 'nullable|exists:students,id']);

            $query = \App\Models\Degree::with(['student', 'quizze']);

            if ($request->student_id) $query->where('student_id', $request->student_id);

            return response()->json([
                'success' => true,
                'data' => $query->paginate(50),
            ]);
        })->name('api.grades.index');

        // --- الاختبارات ---
        Route::get('/quizzes', function () {
            return response()->json([
                'success' => true,
                'data' => \App\Models\Quizze::with(['subject', 'grade', 'classroom'])
                    ->paginate(20),
            ]);
        })->name('api.quizzes.index');

        Route::get('/quizzes/{id}', function ($id) {
            $quiz = \App\Models\Quizze::with(['subject', 'questions'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $quiz]);
        })->name('api.quizzes.show');

        // --- الرسوم ---
        Route::get('/fees', function (Request $request) {
            $request->validate(['student_id' => 'nullable|exists:students,id']);

            $query = \App\Models\Fee_invoice::with(['student', 'fees', 'grade', 'classroom']);

            if ($request->student_id) $query->where('student_id', $request->student_id);

            return response()->json([
                'success' => true,
                'data' => $query->paginate(50),
            ]);
        })->name('api.fees.index');

        // --- المكتبة ---
        Route::get('/library', function () {
            return response()->json([
                'success' => true,
                'data' => \App\Models\Library::with('grade')->paginate(20),
            ]);
        })->name('api.library.index');

        // --- المواد ---
        Route::get('/subjects', function (Request $request) {
            $request->validate([
                'classroom_id' => 'nullable|exists:classrooms,id',
                'term'         => 'nullable|in:1,2',
            ]);

            $query = \App\Models\Subject::with(['grade', 'classroom', 'teacher']);

            if ($request->classroom_id) $query->where('classroom_id', $request->classroom_id);
            if ($request->term) $query->where('term', $request->term);

            return response()->json([
                'success' => true,
                'data' => $query->get(),
            ]);
        })->name('api.subjects.index');

        // --- التحليلات ---
        Route::get('/analytics/dashboard', function (\App\Services\AnalyticsService $analytics) {
            return response()->json([
                'success' => true,
                'data' => $analytics->dashboardStats(),
            ]);
        })->name('api.analytics.dashboard');

        Route::get('/analytics/attendance', function (\App\Services\AnalyticsService $analytics, Request $request) {
            $days = $request->get('days', 30);
            return response()->json([
                'success' => true,
                'data' => $analytics->attendanceTrend($days),
            ]);
        })->name('api.analytics.attendance');

        Route::get('/analytics/financial', function (\App\Services\AnalyticsService $analytics) {
            return response()->json([
                'success' => true,
                'data' => $analytics->financialReport(),
            ]);
        })->name('api.analytics.financial');

        // --- الرسائل ---
        Route::get('/messages', function (Request $request) {
            $user = $request->user();
            return response()->json([
                'success' => true,
                'data' => \App\Models\Message::where(function ($q) use ($user) {
                    $q->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
                })->paginate(20),
            ]);
        })->name('api.messages.index');

        // --- تسجيل الخروج ---
        Route::post('/auth/logout', function (Request $request) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['success' => true, 'message' => 'تم تسجيل الخروج']);
        })->name('api.logout');
    });
});
