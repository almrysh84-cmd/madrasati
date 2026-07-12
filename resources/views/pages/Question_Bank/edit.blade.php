@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    تعديل السؤال
@endsection
@section('page-header')
@endsection
@section('PageTitle')
    تعديل السؤال
@endsection

@section('content')
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

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('question_bank.update', $question->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $question->id }}">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="question_ar">نص السؤال باللغة العربية : <span class="text-danger">*</span></label>
                                        <textarea name="question_ar" class="form-control" rows="3" required>{{ old('question_ar', $question->getTranslation('question', 'ar')) }}</textarea>
                                    </div>
                                    <div class="col">
                                        <label for="question_en">نص السؤال باللغة الإنجليزية :</label>
                                        <textarea name="question_en" class="form-control" rows="3">{{ old('question_en', $question->getTranslation('question', 'en')) }}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="type">نوع السؤال : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="type" id="question_type" required>
                                                <option value="mcq" {{ $question->type == 'mcq' ? 'selected' : '' }}>اختيار من متعدد</option>
                                                <option value="true_false" {{ $question->type == 'true_false' ? 'selected' : '' }}>صح / خطأ</option>
                                                <option value="essay" {{ $question->type == 'essay' ? 'selected' : '' }}>مقالي</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="level">مستوى الصعوبة : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="level" required>
                                                <option value="easy" {{ $question->level == 'easy' ? 'selected' : '' }}>سهل</option>
                                                <option value="medium" {{ $question->level == 'medium' ? 'selected' : '' }}>متوسط</option>
                                                <option value="hard" {{ $question->level == 'hard' ? 'selected' : '' }}>صعب</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="score">الدرجة : <span class="text-danger">*</span></label>
                                            <input type="number" name="score" class="form-control" step="0.5" min="0.5" max="100" value="{{ old('score', $question->score) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subject_id">المادة الدراسية : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id" required>
                                                <option selected disabled>حدد المادة الدراسية...</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ ($subject->id == $question->subject_id || old('subject_id') == $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">المرحلة الدراسية : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id" required>
                                                <option selected disabled>حدد المرحلة...</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ ($grade->id == $question->grade_id || old('Grade_id') == $grade->id) ? 'selected' : '' }}>{{ $grade->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                @php
                                    $existingOptions = $question->options ?? [];
                                    if (!is_array($existingOptions)) { $existingOptions = []; }
                                @endphp

                                <!-- خيارات الاختيار من متعدد -->
                                <div id="mcq_options" style="@if($question->type == 'mcq') display: block; @else display: none; @endif">
                                    <div class="card card-body bg-light mb-3">
                                        <h6><i class="fas fa-list-ol"></i> خيارات السؤال (اختيار من متعدد)</h6>
                                        <div id="options_container">
                                            @forelse($existingOptions as $index => $option)
                                                <div class="form-row mb-2">
                                                    <div class="col-10">
                                                        <input type="text" name="options[]" class="form-control" placeholder="الخيار {{ $loop->iteration }}" value="{{ old('options.' . $index, $option) }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger btn-sm remove-option-btn" onclick="removeOption(this)"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="form-row mb-2">
                                                    <div class="col-10">
                                                        <input type="text" name="options[]" class="form-control" placeholder="الخيار 1" value="{{ old('options.0') }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger btn-sm remove-option-btn" onclick="removeOption(this)"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="form-row mb-2">
                                                    <div class="col-10">
                                                        <input type="text" name="options[]" class="form-control" placeholder="الخيار 2" value="{{ old('options.1') }}">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger btn-sm remove-option-btn" onclick="removeOption(this)"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button type="button" class="btn btn-info btn-sm" onclick="addOption()"><i class="fas fa-plus"></i> إضافة خيار</button>
                                        <br><br>
                                        <label for="correct_answer">الإجابة الصحيحة : <span class="text-danger">*</span></label>
                                        <input type="text" name="correct_answer" id="correct_answer_input" class="form-control" placeholder="اكتب الإجابة الصحيحة مطابقة لأحد الخيارات" value="{{ old('correct_answer', $question->correct_answer) }}">
                                        <small class="text-muted">يجب أن تطابق الإجابة الصحيحة أحد الخيارات أعلاه تماماً</small>
                                    </div>
                                </div>

                                <!-- خيارات صح / خطأ -->
                                <div id="true_false_options" style="@if($question->type == 'true_false') display: block; @else display: none; @endif">
                                    <div class="card card-body bg-light mb-3">
                                        <h6><i class="fas fa-check-circle"></i> الإجابة الصحيحة</h6>
                                        <div class="form-group">
                                            <select class="custom-select mr-sm-2" name="correct_answer">
                                                <option selected disabled>حدد الإجابة الصحيحة...</option>
                                                <option value="صح" {{ $question->correct_answer == 'صح' ? 'selected' : '' }}>صح</option>
                                                <option value="خطأ" {{ $question->correct_answer == 'خطأ' ? 'selected' : '' }}>خطأ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- مشاركة السؤال -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_shared" id="is_shared" value="1" {{ $question->is_shared ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_shared">
                                            مشاركة هذا السؤال مع بقية المعلمين في البنك المركزي
                                        </label>
                                    </div>
                                </div>
                                <br>

                                <a href="{{ route('question_bank.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-right"></i> رجوع
                                </a>
                                <button class="btn btn-success btn-sm btn-lg" type="submit">
                                    <i class="fas fa-save"></i> تأكيد التعديل
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            function toggleOptions() {
                var type = $('select[name="type"]').val();
                $('#mcq_options').hide();
                $('#true_false_options').hide();
                if (type === 'mcq') {
                    $('#mcq_options').show();
                } else if (type === 'true_false') {
                    $('#true_false_options').show();
                }
            }

            $('select[name="type"]').on('change', toggleOptions);

            window.addOption = function () {
                var count = $('#options_container .form-row').length;
                if (count >= 6) {
                    toastr.warning('الحد الأقصى للخيارات هو 6');
                    return;
                }
                var html = '<div class="form-row mb-2">' +
                    '<div class="col-10"><input type="text" name="options[]" class="form-control" placeholder="الخيار ' + (count + 1) + '"></div>' +
                    '<div class="col-2"><button type="button" class="btn btn-danger btn-sm remove-option-btn" onclick="removeOption(this)"><i class="fa fa-times"></i></button></div>' +
                    '</div>';
                $('#options_container').append(html);
            };

            window.removeOption = function (btn) {
                if ($('#options_container .form-row').length <= 2) {
                    toastr.warning('يجب وجود خيارين على الأقل');
                    return;
                }
                $(btn).closest('.form-row').remove();
            };
        });
    </script>
@endsection
