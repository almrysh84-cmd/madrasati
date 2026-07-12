@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        الملف الشخصي
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        الملف الشخصي
    @stop
@endsection
@section('content')
    @php
        // eager-load relations to avoid N+1
        $info = \App\Models\Student::with(['gender', 'grade', 'classroom', 'section', 'Nationality', 'myparent', 'images'])
            ->findOrFail(auth()->user()->id);
    @endphp

    <div class="card-body">
        <section style="background-color: #f5f7fa;">
            <div class="row">
                {{-- ===== البطاقة الجانبية: الصورة + المعلومات الأساسية ===== --}}
                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            @if($info->images && $info->images->isNotEmpty())
                                <img src="{{ asset('attachments/students/' . $info->getTranslation('name', 'ar') . '/' . $info->images->first()->filename) }}"
                                     alt="avatar" class="rounded-circle img-fluid mb-3"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #007bff;"
                                     onerror="this.src='{{ URL::asset('assets/images/student.png') }}'">
                            @else
                                <img src="{{ URL::asset('assets/images/student.png') }}"
                                     alt="avatar" class="rounded-circle img-fluid mb-3"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #007bff;">
                            @endif
                            <h5 style="font-family: 'Cairo', sans-serif" class="my-2 font-weight-bold">
                                {{ $info->getTranslation('name', 'ar') }}
                            </h5>
                            <p class="text-muted mb-1">{{ $info->email }}</p>
                            <span class="badge badge-success mb-2" style="font-size: 14px;">طالب</span>
                            <hr>
                            <div class="text-right" style="font-family: 'Cairo', sans-serif">
                                <p class="mb-2"><i class="fas fa-graduation-cap text-primary ml-2"></i>
                                    {{ $info->grade ? $info->grade->getTranslation('Name', 'ar') : '-' }}
                                </p>
                                <p class="mb-2"><i class="fas fa-chalkboard text-info ml-2"></i>
                                    {{ $info->classroom ? $info->classroom->getTranslation('Name_Class', 'ar') : '-' }}
                                </p>
                                <p class="mb-0"><i class="fas fa-users text-warning ml-2"></i>
                                    {{ $info->section ? $info->section->getTranslation('Name_Section', 'ar') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ===== إحصائيات سريعة ===== --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-primary mb-3" style="font-family: 'Cairo', sans-serif">
                                <i class="fas fa-chart-bar"></i> إحصائياتي
                            </h6>
                            @php
                                $examsCount = \App\Models\Degree::where('student_id', $info->id)->distinct('quizze_id')->count();
                                $totalScore = \App\Models\Degree::where('student_id', $info->id)->sum('score');
                                $attendanceRecords = \App\Models\Attendance::where('student_id', $info->id)->count();
                                $presentDays = \App\Models\Attendance::where('student_id', $info->id)->where('attendence_status', 1)->count();
                                $absentDays = \App\Models\Attendance::where('student_id', $info->id)->where('attendence_status', 0)->count();
                                $attendanceRate = $attendanceRecords > 0 ? round(($presentDays / $attendanceRecords) * 100, 1) : 0;
                            @endphp
                            <div class="row text-center">
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-primary mb-0">{{ $examsCount }}</h4>
                                        <small class="text-muted">اختبار</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-success mb-0">{{ $totalScore }}</h4>
                                        <small class="text-muted">مجموع الدرجات</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <h4 class="text-info mb-0">{{ $attendanceRate }}%</h4>
                                        <small class="text-muted">نسبة الحضور</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <h4 class="text-danger mb-0">{{ $absentDays }}</h4>
                                        <small class="text-muted">أيام الغياب</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== القسم الرئيسي: التفاصيل الكاملة + التعديل ===== --}}
                <div class="col-lg-8">
                    {{-- ===== بطاقة المعلومات الكاملة ===== --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                <i class="fas fa-id-card"></i> المعلومات الكاملة
                            </h5>
                        </div>
                        <div class="card-body" style="font-family: 'Cairo', sans-serif">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted" style="width: 40%"><i class="fas fa-user text-primary ml-2"></i> الاسم (عربي):</td>
                                            <td class="font-weight-bold">{{ $info->getTranslation('name', 'ar') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-user text-primary ml-2"></i> الاسم (إنجليزي):</td>
                                            <td class="font-weight-bold">{{ $info->getTranslation('name', 'en') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-envelope text-primary ml-2"></i> البريد الإلكتروني:</td>
                                            <td class="font-weight-bold">{{ $info->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-venus-mars text-primary ml-2"></i> النوع:</td>
                                            <td class="font-weight-bold">{{ $info->gender ? $info->gender->getTranslation('Name', 'ar') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-flag text-primary ml-2"></i> الجنسية:</td>
                                            <td class="font-weight-bold">{{ $info->Nationality ? $info->Nationality->getTranslation('Name', 'ar') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-tint text-primary ml-2"></i> فصيلة الدم:</td>
                                            <td class="font-weight-bold">{{ $info->blood ? $info->blood->Name : '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted" style="width: 40%"><i class="fas fa-birthday-cake text-primary ml-2"></i> تاريخ الميلاد:</td>
                                            <td class="font-weight-bold">{{ $info->Date_Birth ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-graduation-cap text-primary ml-2"></i> المرحلة:</td>
                                            <td class="font-weight-bold">{{ $info->grade ? $info->grade->getTranslation('Name', 'ar') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-chalkboard text-primary ml-2"></i> الصف:</td>
                                            <td class="font-weight-bold">{{ $info->classroom ? $info->classroom->getTranslation('Name_Class', 'ar') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-users text-primary ml-2"></i> القسم:</td>
                                            <td class="font-weight-bold">{{ $info->section ? $info->section->getTranslation('Name_Section', 'ar') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-user-tie text-primary ml-2"></i> ولي الأمر:</td>
                                            <td class="font-weight-bold">
                                                {{ $info->myparent ? $info->myparent->getTranslation('Name_Father', 'ar') : '-' }}
                                                @if($info->myparent)
                                                    <br><small class="text-muted">{{ $info->myparent->email }}</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-calendar text-primary ml-2"></i> السنة الدراسية:</td>
                                            <td class="font-weight-bold">{{ $info->academic_year ?: '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== بطاقة تعديل البيانات ===== --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                <i class="fas fa-edit"></i> تعديل البيانات
                            </h5>
                        </div>
                        <div class="card-body" style="font-family: 'Cairo', sans-serif">
                            <form action="{{ route('profile-student.update', $info->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label><i class="fas fa-user text-primary"></i> الاسم بالعربية</label>
                                        <input type="text" name="Name_ar"
                                               value="{{ $info->getTranslation('name', 'ar') }}"
                                               class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label><i class="fas fa-user text-primary"></i> الاسم بالإنجليزية</label>
                                        <input type="text" name="Name_en"
                                               value="{{ $info->getTranslation('name', 'en') }}"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label><i class="fas fa-lock text-primary"></i> كلمة المرور الجديدة (اتركها فارغة للإبقاء على الحالية)</label>
                                        <div class="input-group">
                                            <input type="password" id="password" class="form-control" name="password"
                                                   placeholder="••••••••" autocomplete="new-password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                                                    <i class="fas fa-eye" id="pwd-icon"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <small class="text-muted">اترك هذا الحقل فارغاً إذا لا تريد تغيير كلمة المرور.</small>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-save"></i> حفظ التعديلات
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            var icon = document.getElementById("pwd-icon");
            if (x.type === "password") {
                x.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                x.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
@endsection
