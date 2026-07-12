@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
    إضافة سؤال جديد
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
    إضافة سؤال جديد
    @stop
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 mb-30">
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

                    <h4 class="mb-3" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-question-circle text-primary"></i>
                        إضافة سؤال جديد
                    </h4>

                    <form action="{{ route('questions.store') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" value="{{$quizz_id}}" name="quizz_id">

                        {{-- نوع السؤال --}}
                        <div class="form-group">
                            <label style="font-weight: bold;">
                                <i class="fas fa-list-alt text-info"></i>
                                نوع السؤال
                            </label>
                            <select class="form-control" name="question_type" id="question_type" onchange="toggleQuestionType()">
                                <option value="mcq" selected>اختيارات من متعدد</option>
                                <option value="true_false">صح / خطأ</option>
                                <option value="manual">إدخال يدوي (نص حر)</option>
                            </select>
                            <small class="text-muted">اختر نوع السؤال لعرض النموذج المناسب.</small>
                        </div>

                        {{-- نص السؤال --}}
                        <div class="form-group">
                            <label style="font-weight: bold;">
                                <i class="fas fa-edit text-primary"></i>
                                نص السؤال
                            </label>
                            <textarea name="title" id="input-question"
                                      class="form-control" rows="3"
                                      placeholder="اكتب نص السؤال هنا..." required></textarea>
                        </div>

                        {{-- ===== قسم صح/خطأ ===== --}}
                        <div id="true_false_section" style="display: none;">
                            <div class="form-group">
                                <label style="font-weight: bold;">
                                    <i class="fas fa-check text-success"></i>
                                    الإجابة الصحيحة
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-success" style="cursor: pointer;" onclick="selectTrueFalse(this, 'صح')">
                                            <div class="card-body text-center">
                                                <i class="fas fa-check-circle text-success fa-2x"></i>
                                                <h5 class="mt-2 mb-0">صح</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-danger" style="cursor: pointer;" onclick="selectTrueFalse(this, 'خطأ')">
                                            <div class="card-body text-center">
                                                <i class="fas fa-times-circle text-danger fa-2x"></i>
                                                <h5 class="mt-2 mb-0">خطأ</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="tf_answer" id="tf_answer" value="">
                            </div>
                        </div>

                        {{-- ===== قسم اختيارات من متعدد ===== --}}
                        <div id="mcq_section">
                            <div class="form-group">
                                <label style="font-weight: bold;">
                                    <i class="fas fa-list-ol text-info"></i>
                                    الخيارات (يمكنك إضافة حتى 6 خيارات)
                                </label>
                                <div id="options_container">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">A</span>
                                        </div>
                                        <input type="text" class="form-control option-input" placeholder="الخيار الأول" oninput="updateAnswers()">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-success" onclick="markAsCorrect(this)" title="تحديد كإجابة صحيحة">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">B</span>
                                        </div>
                                        <input type="text" class="form-control option-input" placeholder="الخيار الثاني" oninput="updateAnswers()">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-success" onclick="markAsCorrect(this)" title="تحديد كإجابة صحيحة">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-sm mt-2" onclick="addOption()">
                                    <i class="fas fa-plus"></i> إضافة خيار آخر
                                </button>
                                <small class="text-muted d-block mt-1">اضغط على زر <i class="fas fa-check text-success"></i> بجانب الخيار الصحيح لتمييزه (سيظهر باللون الأخضر).</small>
                            </div>

                            {{-- حقل مخفي للإجابات (يُملأ تلقائياً) --}}
                            <input type="hidden" name="answers" id="answers_input" value="">
                            <input type="hidden" name="right_answer" id="right_answer_input" value="">
                        </div>

                        {{-- ===== قسم الإدخال اليدوي ===== --}}
                        <div id="manual_section" style="display: none;">
                            <div class="form-group">
                                <label style="font-weight: bold;">
                                    <i class="fas fa-keyboard text-warning"></i>
                                    الإجابات (افصل بينها بعلامة -)
                                </label>
                                <textarea name="manual_answers" id="manual_answers" class="form-control" rows="3"
                                          placeholder="مثال: الإجابة الأولى - الإجابة الثانية - الإجابة الثالثة"
                                          oninput="document.getElementById('answers_input').value = this.value;"></textarea>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;">الإجابة الصحيحة</label>
                                <input type="text" name="manual_right_answer" id="manual_right_answer" class="form-control"
                                       placeholder="اكتب الإجابة الصحيحة كما هي بالضبط"
                                       oninput="document.getElementById('right_answer_input').value = this.value;">
                            </div>
                        </div>

                        {{-- الدرجة --}}
                        <div class="form-group">
                            <label style="font-weight: bold;">
                                <i class="fas fa-star text-warning"></i>
                                الدرجة
                            </label>
                            <select class="form-control" name="score" required>
                                <option value="" selected disabled>حدد الدرجة...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>

                        <button class="btn btn-success btn-lg w-100" type="submit">
                            <i class="fas fa-save"></i> حفظ السؤال
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
    <script>
        var optionCount = 2;
        var correctOptionIndex = -1;
        var maxOptions = 6;

        function toggleQuestionType() {
            var type = document.getElementById('question_type').value;
            document.getElementById('mcq_section').style.display = (type === 'mcq') ? 'block' : 'none';
            document.getElementById('true_false_section').style.display = (type === 'true_false') ? 'block' : 'none';
            document.getElementById('manual_section').style.display = (type === 'manual') ? 'block' : 'none';

            // تحديث الحقول المخفية حسب النوع
            if (type === 'true_false') {
                document.getElementById('answers_input').value = 'صح - خطأ';
            } else if (type === 'manual') {
                updateManual();
            } else {
                updateAnswers();
            }
        }

        function addOption() {
            if (optionCount >= maxOptions) {
                alert('الحد الأقصى ' + maxOptions + ' خيارات');
                return;
            }
            var letter = String.fromCharCode(65 + optionCount); // C, D, E, F
            var container = document.getElementById('options_container');
            var div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = '' +
                '<div class="input-group-prepend">' +
                '  <span class="input-group-text bg-primary text-white">' + letter + '</span>' +
                '</div>' +
                '<input type="text" class="form-control option-input" placeholder="الخيار ' + (optionCount + 1) + '" oninput="updateAnswers()">' +
                '<div class="input-group-append">' +
                '  <button type="button" class="btn btn-outline-success" onclick="markAsCorrect(this)" title="تحديد كإجابة صحيحة">' +
                '    <i class="fas fa-check"></i>' +
                '  </button>' +
                '  <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.parentElement.remove(); optionCount--; renumberOptions(); updateAnswers();" title="حذف">' +
                '    <i class="fas fa-trash"></i>' +
                '  </button>' +
                '</div>';
            container.appendChild(div);
            optionCount++;
            renumberOptions();
            updateAnswers();
        }

        function renumberOptions() {
            var groups = document.querySelectorAll('#options_container .input-group');
            groups.forEach(function(g, i) {
                var span = g.querySelector('.input-group-text');
                if (span) span.textContent = String.fromCharCode(65 + i);
            });
        }

        function markAsCorrect(btn) {
            // إعادة تعيين كل الأزرار
            document.querySelectorAll('#options_container .btn-success, #options_container .btn-outline-success').forEach(function(b) {
                if (b.classList.contains('btn-success')) {
                    b.classList.remove('btn-success');
                    b.classList.add('btn-outline-success');
                }
            });
            // تمييز الزر الحالي
            btn.classList.remove('btn-outline-success');
            btn.classList.add('btn-success');
            // تحديد فهرس الإجابة الصحيحة
            var group = btn.closest('.input-group');
            var groups = Array.from(document.querySelectorAll('#options_container .input-group'));
            correctOptionIndex = groups.indexOf(group);
            updateAnswers();
        }

        function updateAnswers() {
            var inputs = document.querySelectorAll('#options_container .option-input');
            var answers = [];
            inputs.forEach(function(inp) {
                var v = inp.value.trim();
                if (v) answers.push(v);
            });
            // الحقل answers يُفصل بـ " - "
            document.getElementById('answers_input').value = answers.join(' - ');

            // الإجابة الصحيحة
            if (correctOptionIndex >= 0 && correctOptionIndex < answers.length) {
                document.getElementById('right_answer_input').value = answers[correctOptionIndex];
            }
        }

        function selectTrueFalse(element, value) {
            // إزالة التحديد من البطاقتين
            document.querySelectorAll('#true_false_section .card').forEach(function(c) {
                c.style.borderWidth = '1px';
                c.style.opacity = '0.7';
            });
            // تمييز البطاقة المختارة
            element.style.borderWidth = '4px';
            element.style.opacity = '1';
            document.getElementById('tf_answer').value = value;
            document.getElementById('right_answer_input').value = value;
        }

        function updateManual() {
            document.getElementById('answers_input').value = document.getElementById('manual_answers').value;
            document.getElementById('right_answer_input').value = document.getElementById('manual_right_answer').value;
        }

        // التهيئة الأولية
        document.addEventListener('DOMContentLoaded', function() {
            updateAnswers();
        });

        // قبل إرسال النموذج، تأكد من وجود إجابة صحيحة
        document.querySelector('form').addEventListener('submit', function(e) {
            var type = document.getElementById('question_type').value;
            var rightAnswer = document.getElementById('right_answer_input').value;
            var answers = document.getElementById('answers_input').value;

            if (!answers.trim()) {
                e.preventDefault();
                alert('يرجى إدخال الإجابات أولاً');
                return;
            }
            if (!rightAnswer.trim()) {
                e.preventDefault();
                if (type === 'mcq') {
                    alert('يرجى تحديد الإجابة الصحيحة بالضغط على زر ✓ بجانب الخيار الصحيح');
                } else if (type === 'true_false') {
                    alert('يرجى اختيار صح أو خطأ');
                } else {
                    alert('يرجى إدخال الإجابة الصحيحة');
                }
                return;
            }

            // تعطيل حقول manual إذا لم تكن manual mode (لمنع إرسالها)
            if (type !== 'manual') {
                var ma = document.getElementById('manual_answers');
                var mr = document.getElementById('manual_right_answer');
                if (ma) ma.removeAttribute('name');
                if (mr) mr.removeAttribute('name');
            }
            // تعطيل tf_answer إذا لم تكن true_false mode
            if (type !== 'true_false') {
                var tfa = document.getElementById('tf_answer');
                if (tfa) tfa.removeAttribute('name');
            }
        });
    </script>
@endsection
