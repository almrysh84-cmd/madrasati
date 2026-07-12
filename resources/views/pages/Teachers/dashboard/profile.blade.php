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
        // eager-load relations (Section model uses Grades + My_classs, not grade + classroom)
        $info = \App\Models\Teacher::with(['specializations', 'genders', 'Sections', 'Sections.Grades', 'Sections.My_classs'])
            ->findOrFail(auth()->user()->id);
        $teacherSubjects = \App\Models\Subject::where('teacher_id', $info->id)->with('grade', 'classroom')->get();
    @endphp

    <div class="card-body">
        <section style="background-color: #f5f7fa;">
            <div class="row">
                {{-- ===== البطاقة الجانبية: الصورة + المعلومات الأساسية ===== --}}
                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{ URL::asset('assets/images/teacher.png') }}"
                                 alt="avatar" class="rounded-circle img-fluid mb-3"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #28a745;">
                            <h5 style="font-family: 'Cairo', sans-serif" class="my-2 font-weight-bold">
                                {{ $info->getTranslation('name', 'ar') }}
                            </h5>
                            <p class="text-muted mb-1">{{ $info->email }}</p>
                            <span class="badge badge-success mb-2" style="font-size: 14px;">معلم</span>
                            <hr>
                            <div class="text-right" style="font-family: 'Cairo', sans-serif">
                                <p class="mb-2"><i class="fas fa-briefcase text-primary ml-2"></i>
                                    {{ $info->specializations ? $info->specializations->Name : '-' }}
                                </p>
                                <p class="mb-2"><i class="fas fa-calendar text-info ml-2"></i>
                                    تاريخ الالتحاق: {{ $info->Joining_Date ?: '-' }}
                                </p>
                                <p class="mb-0"><i class="fas fa-map-marker-alt text-warning ml-2"></i>
                                    {{ $info->Address ?: '-' }}
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
                                $sectionsCount = $info->Sections ? $info->Sections->count() : 0;
                                $sectionIds = $info->Sections ? $info->Sections->pluck('id') : collect([]);
                                $studentsCount = \App\Models\Student::whereIn('section_id', $sectionIds)->count();
                                $subjectsCount = $teacherSubjects->count();
                                $quizzesCount = \App\Models\Quizze::where('teacher_id', $info->id)->count();
                                $homeworkCount = \App\Models\Homework::where('teacher_id', $info->id)->count();
                            @endphp
                            <div class="row text-center">
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-primary mb-0">{{ $sectionsCount }}</h4>
                                        <small class="text-muted">قسم</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-success mb-0">{{ $studentsCount }}</h4>
                                        <small class="text-muted">طالب</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-info mb-0">{{ $subjectsCount }}</h4>
                                        <small class="text-muted">مادة</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="border rounded p-2">
                                        <h4 class="text-warning mb-0">{{ $quizzesCount }}</h4>
                                        <small class="text-muted">اختبار</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="border rounded p-2">
                                        <h4 class="text-danger mb-0">{{ $homeworkCount }}</h4>
                                        <small class="text-muted">واجب</small>
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
                                            <td class="text-muted" style="width: 45%"><i class="fas fa-user text-primary ml-2"></i> الاسم (عربي):</td>
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
                                            <td class="text-muted"><i class="fas fa-briefcase text-primary ml-2"></i> التخصص:</td>
                                            <td class="font-weight-bold">{{ $info->specializations ? $info->specializations->Name : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-venus-mars text-primary ml-2"></i> النوع:</td>
                                            <td class="font-weight-bold">{{ $info->genders ? $info->genders->Name : '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted" style="width: 45%"><i class="fas fa-calendar text-primary ml-2"></i> تاريخ الالتحاق:</td>
                                            <td class="font-weight-bold">{{ $info->Joining_Date ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-map-marker-alt text-primary ml-2"></i> العنوان:</td>
                                            <td class="font-weight-bold">{{ $info->Address ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-chalkboard text-primary ml-2"></i> عدد الأقسام:</td>
                                            <td class="font-weight-bold">{{ $sectionsCount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-book text-primary ml-2"></i> عدد المواد:</td>
                                            <td class="font-weight-bold">{{ $subjectsCount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted"><i class="fas fa-calendar-plus text-primary ml-2"></i> تاريخ الإنشاء:</td>
                                            <td class="font-weight-bold">{{ $info->created_at ? $info->created_at->format('Y-m-d') : '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== بطاقة الأقسام والمواد ===== --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                <i class="fas fa-chalkboard-teacher"></i> الأقسام والمواد التي أُدرّسها
                            </h5>
                        </div>
                        <div class="card-body" style="font-family: 'Cairo', sans-serif">
                            <h6 class="text-primary mb-3"><i class="fas fa-users"></i> الأقسام</h6>
                            @if($info->Sections && $info->Sections->isNotEmpty())
                                <div class="row mb-4">
                                    @foreach($info->Sections as $section)
                                        <div class="col-md-4 mb-2">
                                            <div class="card border-info">
                                                <div class="card-body p-2">
                                                    <p class="mb-0">
                                                        <strong>{{ $section->My_classs ? $section->My_classs->getTranslation('Name_Class', 'ar') : '-' }}</strong>
                                                    </p>
                                                    <small class="text-muted">
                                                        {{ $section->Grades ? $section->Grades->getTranslation('Name', 'ar') : '' }} -
                                                        قسم {{ $section->getTranslation('Name_Section', 'ar') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">لم يتم تعيين أقسام لك بعد. تواصل مع الإدارة.</p>
                            @endif

                            <h6 class="text-success mb-3"><i class="fas fa-book"></i> المواد</h6>
                            @if($teacherSubjects->isNotEmpty())
                                <div class="row">
                                    @foreach($teacherSubjects as $subject)
                                        <div class="col-md-6 mb-2">
                                            <div class="card border-success">
                                                <div class="card-body p-2">
                                                    <p class="mb-0">
                                                        <strong>{{ $subject->getTranslation('name', 'ar') }}</strong>
                                                    </p>
                                                    <small class="text-muted">
                                                        {{ $subject->grade ? $subject->grade->getTranslation('Name', 'ar') : '' }} -
                                                        {{ $subject->classroom ? $subject->classroom->getTranslation('Name_Class', 'ar') : '' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">لم يتم تعيين مواد لك بعد. تواصل مع الإدارة.</p>
                            @endif
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
                            <form action="{{ route('profile.update', $info->id) }}" method="post">
                                @csrf
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
