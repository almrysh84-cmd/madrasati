@extends('layouts.master')

@section('css')
    @toastr_css
    @section('title')
        إضافة إعلان
    @stop
@endsection

@section('page-header')
    @section('PageTitle')
        إضافة إعلان جديد
    @stop
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('teacher.announcements.index') }}" class="btn btn-secondary btn-sm mb-3">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>

                    <h4 class="mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-bullhorn text-success"></i>
                        نشر إعلان للطلاب
                    </h4>

                    <p class="text-muted">
                        الإعلان سيظهر مباشرة في لوحة تحكم الطلاب. يمكن استخدامه لإبلاغ الطلاب بأي شيء:
                        موعد اختبار، تأخر معلم، حصة استثنائية، إلخ.
                    </p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('teacher.announcements.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label style="font-weight: bold;">عنوان الإعلان *</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title') }}" required
                                   placeholder="مثال: اختبار رياضيات يوم الأحد القادم">
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">نص الإعلان *</label>
                            <textarea name="body" class="form-control" rows="6" required
                                      placeholder="اكتب تفاصيل الإعلان هنا...">{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">الجمهور المستهدف *</label>
                            <select name="target_audience" class="form-control" required>
                                <option value="students" @if(old('target_audience') == 'students') selected @endif>
                                    طلابي فقط
                                </option>
                                <option value="all" @if(old('target_audience') == 'all') selected @endif>
                                    جميع الطلاب في المدرسة
                                </option>
                            </select>
                            <small class="text-muted">المعلم يمكنه استهداف الطلاب فقط.</small>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">تاريخ ووقت النشر (اختياري)</label>
                            <input type="datetime-local" name="publish_at" class="form-control"
                                   value="{{ old('publish_at') }}">
                            <small class="text-muted">اتركه فارغاً للنشر الفوري.</small>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> نشر الإعلان
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
