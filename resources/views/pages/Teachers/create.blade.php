@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Add_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Add_Teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('Teachers.store')}}" method="post">
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                    <input type="email" name="Email" class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                    <input type="password" name="Password" class="form-control">
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                    <input type="text" name="Name_ar" class="form-control">
                                    @error('Name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                                    <input type="text" name="Name_en" class="form-control">
                                    @error('Name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('Joining_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                <textarea class="form-control" name="Address"
                                          id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('Address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ===== تحديد الفصول/الأقسام التي يدرسها المعلم ===== --}}
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 16px;">
                                    <i class="fas fa-chalkboard-teacher text-primary"></i>
                                    الفصول/الأقسام التي يدرسها المعلم
                                </label>
                                <p class="text-muted small">حدد الأقسام (الشُّعَب) التي سيكون المعلم مسؤولاً عنها. المعلم سيرى فقط طلاب هذه الأقسام في لوحة تحكمه.</p>

                                @php
                                    $sectionsByGrade = \App\Models\Section::with(['Grades', 'My_classs'])
                                        ->orderBy('Grade_id')->orderBy('Class_id')->get()
                                        ->groupBy(function($s) {
                                            return $s->Grades ? $s->Grades->getTranslation('Name', 'ar') : 'غير محدد';
                                        });
                                @endphp

                                <div class="card border-light">
                                    <div class="card-body" style="max-height: 350px; overflow-y: auto;">
                                        @foreach($sectionsByGrade as $gradeName => $sections)
                                            <div class="mb-3">
                                                <h6 class="text-primary mb-2" style="font-weight: bold;">
                                                    <i class="fas fa-layer-group"></i> {{ $gradeName }}
                                                </h6>
                                                <div class="row">
                                                    @foreach($sections as $section)
                                                        <div class="col-md-4 col-sm-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="checkbox"
                                                                       name="sections[]"
                                                                       value="{{ $section->id }}"
                                                                       id="section_{{ $section->id }}"
                                                                       class="form-check-input">
                                                                <label for="section_{{ $section->id }}" class="form-check-label">
                                                                    {{ $section->My_classs ? $section->My_classs->getTranslation('Name_Class', 'ar') : '' }}
                                                                    -
                                                                    {{ $section->getTranslation('Name_Section', 'ar') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- ===== تحديد المواد التي يدرسها المعلم ===== --}}
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 16px;">
                                    <i class="fas fa-book text-success"></i>
                                    المواد التي يدرسها المعلم
                                </label>
                                <p class="text-muted small">حدد المواد التي سيكون المعلم مسؤولاً عنها. المعلم سيرى هذه المواد في لوحة تحكمه (للحضور، الواجبات، الاختبارات). كل مادة تُربط بمعلم واحد فقط.</p>

                                @php
                                    $subjectsByGrade = \App\Models\Subject::with(['grade', 'classroom'])
                                        ->orderBy('grade_id')->orderBy('classroom_id')->get()
                                        ->groupBy(function($s) {
                                            return $s->grade ? $s->grade->getTranslation('Name', 'ar') : 'غير محدد';
                                        });
                                @endphp

                                <div class="card border-light">
                                    <div class="card-body" style="max-height: 350px; overflow-y: auto;">
                                        @foreach($subjectsByGrade as $gradeName => $subjects)
                                            <div class="mb-3">
                                                <h6 class="text-success mb-2" style="font-weight: bold;">
                                                    <i class="fas fa-layer-group"></i> {{ $gradeName }}
                                                    <small class="text-muted">({{ $subjects->count() }} مادة)</small>
                                                </h6>
                                                <div class="row">
                                                    @foreach($subjects as $subject)
                                                        <div class="col-md-6 col-sm-12 mb-2">
                                                            <div class="form-check">
                                                                <input type="checkbox"
                                                                       name="subjects[]"
                                                                       value="{{ $subject->id }}"
                                                                       id="subject_{{ $subject->id }}"
                                                                       class="form-check-input">
                                                                <label for="subject_{{ $subject->id }}" class="form-check-label">
                                                                    {{ $subject->getTranslation('name', 'ar') }}
                                                                    @if($subject->classroom)
                                                                        <small class="text-muted">({{ $subject->classroom->getTranslation('Name_Class', 'ar') }})</small>
                                                                    @endif
                                                                    @if($subject->teacher)
                                                                        <small class="text-warning">— مرتبطة بمعلم آخر</small>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($subjectsByGrade->isEmpty())
                                            <div class="alert alert-warning">لا توجد مواد في النظام. أضف مواد أولاً من صفحة المواد.</div>
                                        @endif
                                    </div>
                                </div>
                                <small class="text-muted">ملاحظة: المواد المرتبطة بمعلم آخر سيتم إعادة ربطها بالمعلم الجديد عند اختيارها.</small>
                            </div>
                            {{-- ===== نهاية تحديد المواد ===== --}}

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Parent_trans.Next')}}</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
