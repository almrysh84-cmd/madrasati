@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        {{ $subject->getTranslation('name', 'ar') }}
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        {{ $subject->getTranslation('name', 'ar') }}
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            {{-- ===== معلومات المادة والمعلم ===== --}}
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white">
                    <a href="{{ url('/en/student_subjects') }}" class="btn btn-sm btn-light ml-2">
                        <i class="fas fa-arrow-right"></i> رجوع للمواد
                    </a>
                    <span style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-book"></i>
                        {{ $subject->getTranslation('name', 'ar') }}
                    </span>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary"><i class="fas fa-info-circle"></i> معلومات المادة</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted"><i class="fas fa-book text-primary"></i> اسم المادة:</td>
                                    <td><strong>{{ $subject->getTranslation('name', 'ar') }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><i class="fas fa-graduation-cap text-primary"></i> المرحلة:</td>
                                    <td><strong>{{ $subject->grade ? $subject->grade->getTranslation('Name', 'ar') : '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><i class="fas fa-chalkboard text-primary"></i> الصف:</td>
                                    <td><strong>{{ $subject->classroom ? $subject->classroom->getTranslation('Name_Class', 'ar') : '-' }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-info"><i class="fas fa-chalkboard-teacher"></i> معلم المادة</h5>
                            @if($subject->teacher)
                                <div class="card border-info">
                                    <div class="card-body text-center">
                                        <img src="{{ URL::asset('assets/images/teacher.png') }}"
                                             class="rounded-circle mb-2" style="width: 80px; height: 80px;">
                                        <h5><strong>{{ $subject->teacher->getTranslation('name', 'ar') }}</strong></h5>
                                        <p class="text-muted mb-2">{{ $subject->teacher->email }}</p>
                                        @if($subject->teacher->specializations)
                                            <p class="text-muted"><i class="fas fa-briefcase"></i> {{ $subject->teacher->specializations->Name }}</p>
                                        @endif
                                        <a href="{{ url('/en/student_subjects/' . $subject->id . '/messages') }}"
                                           class="btn btn-info btn-sm w-100">
                                            <i class="fas fa-comments"></i> مراسلة المعلم
                                        </a>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">لا يوجد معلم مرتبط بهذه المادة حالياً.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== الإحصائيات السريعة ===== --}}
            <div class="row mb-4">
                <div class="col-md-3 mb-2">
                    <div class="card border-info text-center">
                        <div class="card-body">
                            <i class="fas fa-tasks text-info fa-2x"></i>
                            <h3 class="mt-2 mb-0 text-info">{{ $homeworks->count() }}</h3>
                            <small class="text-muted">واجبات</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card border-warning text-center">
                        <div class="card-body">
                            <i class="fas fa-file-alt text-warning fa-2x"></i>
                            <h3 class="mt-2 mb-0 text-warning">{{ $quizzes->count() }}</h3>
                            <small class="text-muted">اختبارات</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card border-success text-center">
                        <div class="card-body">
                            <i class="fas fa-star text-success fa-2x"></i>
                            <h3 class="mt-2 mb-0 text-success">{{ $degrees->sum('score') }}</h3>
                            <small class="text-muted">مجموع درجاتي</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card border-primary text-center">
                        <div class="card-body">
                            <i class="fas fa-calendar-check text-primary fa-2x"></i>
                            <h3 class="mt-2 mb-0 text-primary">{{ $presentCount }}/{{ $presentCount + $absentCount }}</h3>
                            <small class="text-muted">أيام الحضور</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== الواجبات ===== --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-tasks"></i> الواجبات ({{ $homeworks->count() }})
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    @if($homeworks->isEmpty())
                        <p class="text-muted text-center py-3"><i class="fas fa-info-circle"></i> لا توجد واجبات في هذه المادة حالياً.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr class="alert-info">
                                        <th>#</th>
                                        <th>عنوان الواجب</th>
                                        <th>تاريخ التسليم</th>
                                        <th>الدرجة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($homeworks as $hw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $hw->getTranslation('title', 'ar') }}</td>
                                            <td>
                                                @if($hw->due_date)
                                                    <span style="color: {{ \Carbon\Carbon::parse($hw->due_date)->lt(now()) ? '#dc3545' : '#28a745' }}">
                                                        {{ $hw->due_date }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td><span class="badge badge-warning">{{ $hw->score }}</span></td>
                                            <td>
                                                <a href="{{ url('/en/my_homework/' . $hw->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ===== الاختبارات والدرجات ===== --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-file-alt"></i> الاختبارات والدرجات
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    @if($quizzes->isEmpty())
                        <p class="text-muted text-center py-3"><i class="fas fa-info-circle"></i> لا توجد اختبارات في هذه المادة حالياً.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr class="alert-warning">
                                        <th>#</th>
                                        <th>اسم الاختبار</th>
                                        <th>درجتي</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $takenQuizIds = $degrees->pluck('quizze_id')->toArray();
                                    @endphp
                                    @foreach($quizzes as $quiz)
                                        @php
                                            $myDegree = $degrees->firstWhere('quizze_id', $quiz->id);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $quiz->getTranslation('name', 'ar') }}</td>
                                            <td>
                                                @if($myDegree)
                                                    <span class="badge badge-success">{{ $myDegree->score }}</span>
                                                @else
                                                    <span class="badge badge-secondary">لم يُخض</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($myDegree)
                                                    @if($myDegree->abuse == '1')
                                                        <span class="badge badge-danger">ملغي (تلاعب)</span>
                                                    @else
                                                        <span class="badge badge-success">مُكتمل</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-info">متاح</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$myDegree)
                                                    <a href="{{ url('/en/take_quiz/' . $quiz->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-pen"></i> أداء الاختبار
                                                    </a>
                                                @else
                                                    <span class="text-muted"><i class="fas fa-check"></i> أُدِّي</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ===== سجل الحضور ===== --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-calendar-check"></i> سجل الحضور في هذه المادة
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    @if($attendanceRecords->isEmpty())
                        <p class="text-muted text-center py-3"><i class="fas fa-info-circle"></i> لا يوجد سجل حضور في هذه المادة.</p>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i>
                                    أيام الحضور: <strong>{{ $presentCount }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle"></i>
                                    أيام الغياب: <strong>{{ $absentCount }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr class="alert-success">
                                        <th>#</th>
                                        <th>التاريخ</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendanceRecords as $att)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $att->attendence_date }}</td>
                                            <td>
                                                @if($att->attendence_status)
                                                    <span class="badge badge-success">حاضر</span>
                                                @else
                                                    <span class="badge badge-danger">غائب</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
