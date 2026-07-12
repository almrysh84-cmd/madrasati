@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        تفاصيل الواجب
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        تفاصيل الواجب
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('student.homework.index') }}" class="btn btn-secondary btn-sm mb-3">
                        <i class="fas fa-arrow-right"></i> رجوع للقائمة
                    </a>

                    <div class="card mb-4">
                        <div class="card-header alert-info">
                            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">
                                {{ $homework->getTranslation('title', 'ar') }}
                            </h4>
                        </div>
                        <div class="card-body" style="font-family: 'Cairo', sans-serif">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>المادة:</strong>
                                    {{ $homework->subject ? $homework->subject->getTranslation('name', 'ar') : '-' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>المعلم:</strong>
                                    {{ $homework->teacher ? $homework->teacher->getTranslation('name', 'ar') : '-' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>الدرجة:</strong>
                                    <span class="badge badge-warning">{{ $homework->score }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>تاريخ التسليم:</strong>
                                    <span style="color: {{ $homework->due_date && \Carbon\Carbon::parse($homework->due_date)->lt(now()) ? '#dc3545' : '#28a745' }}">
                                        {{ $homework->due_date ?: '-' }}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <strong>النوع:</strong>
                                    @php
                                        $typeMap = ['file' => 'ملف', 'image' => 'صورة', 'question' => 'أسئلة'];
                                    @endphp
                                    {{ $typeMap[$homework->type] ?? $homework->type }}
                                </div>
                            </div>

                            @if($homework->getTranslation('description', 'ar'))
                                <div class="mb-3">
                                    <strong>التعليمات:</strong>
                                    <p class="mt-1">{!! nl2br(e($homework->getTranslation('description', 'ar'))) !!}</p>
                                </div>
                            @endif

                            @if(in_array($homework->type, ['file','image']) && $homework->file_name)
                                <div class="mb-3">
                                    <a href="{{ route('student.homework.download', $homework->file_name) }}"
                                       class="btn btn-success" target="_blank">
                                        <i class="fas fa-download"></i> تنزيل ملف الواجب
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($homework->type === 'question' && $homework->questions->count() > 0)
                        <div class="card">
                            <div class="card-header alert-success">
                                <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">أسئلة الواجب</h5>
                            </div>
                            <div class="card-body" style="font-family: 'Cairo', sans-serif">
                                @foreach($homework->questions as $idx => $q)
                                    <div class="mb-3 p-3 border-bottom">
                                        <h6><strong>السؤال {{ $idx + 1 }}:</strong> {{ $q->title }}</h6>
                                        @if($q->score)
                                            <span class="badge badge-info">الدرجة: {{ $q->score }}</span>
                                        @endif
                                        @if($q->answers)
                                            <div class="mt-2">
                                                <strong>الإجابات المحتملة:</strong>
                                                <ul>
                                                    @foreach(explode('-', $q->answers) as $answer)
                                                        @if(trim($answer))
                                                            <li>{{ trim($answer) }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
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
