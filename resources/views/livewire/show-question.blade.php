<div class="quiz-container" style="font-family: 'Cairo', sans-serif;">
    {{-- Progress bar --}}
    @if($questioncount > 0)
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">
                <i class="fas fa-question-circle"></i>
                السؤال {{ $counter + 1 }} من {{ $questioncount }}
            </span>
            <span class="badge badge-info">
                {{ round(($counter / $questioncount) * 100) }}% مكتمل
            </span>
        </div>
        <div class="progress" style="height: 8px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 role="progressbar"
                 style="width: {{ ($counter / $questioncount) * 100 }}%"
                 aria-valuenow="{{ ($counter / $questioncount) * 100 }}"
                 aria-valuemin="0"
                 aria-valuemax="100"></div>
        </div>
    </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-question-circle"></i>
                {{ $data[$counter]->title }}
            </h5>
        </div>
        <div class="card-body p-4">
            @php
                // تحديد نوع السؤال: صح/خطأ أو اختيارات من متعدد
                $answers = preg_split('/(-)/', $data[$counter]->answers);
                $answers = array_map('trim', $answers);
                $answers = array_filter($answers, fn($a) => strlen($a) > 0);
                $answers = array_values($answers);
                $isTrueFalse = (count($answers) === 2 &&
                    (
                        (in_array('صح', $answers) && in_array('خطأ', $answers)) ||
                        (in_array('true', array_map('strtolower', $answers)) && in_array('false', array_map('strtolower', $answers))) ||
                        (in_array('نعم', $answers) && in_array('لا', $answers))
                    )
                );
            @endphp

            @if($isTrueFalse)
                {{-- ===== صح / خطأ (عرض كبطاقتين كبيرتين) ===== --}}
                <div class="row">
                    @foreach($answers as $index => $answer)
                        <div class="col-md-6 mb-3">
                            <div class="card answer-card h-100 border-{{ $answer === 'صح' || strtolower($answer) === 'true' || $answer === 'نعم' ? 'success' : 'danger' }}"
                                 style="cursor: pointer; transition: all 0.2s;"
                                 onclick="selectAnswer(this, '{{$data[$counter]->id}}', '{{ addslashes($answer) }}')">
                                <div class="card-body text-center p-5">
                                    <i class="fas fa-{{ $answer === 'صح' || strtolower($answer) === 'true' || $answer === 'نعم' ? 'check-circle text-success' : 'times-circle text-danger' }} fa-3x mb-3"></i>
                                    <h4 class="mb-0">{{ $answer }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- ===== اختيارات من متعدد ===== --}}
                <div class="list-group">
                    @foreach($answers as $index => $answer)
                        <div class="list-group-item list-group-item-action answer-card"
                             style="cursor: pointer; transition: all 0.2s; font-size: 16px; padding: 16px;"
                             onclick="selectAnswer(this, '{{$data[$counter]->id}}', '{{ addslashes($answer) }}')">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary badge-pill mr-3" style="font-size: 18px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    {{ chr(65 + $index) }}
                                </span>
                                <span class="flex-grow-1">{{ $answer }}</span>
                                <i class="fas fa-arrow-right text-muted ml-3"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- زر تأكيد الإجابة (يظهر بعد اختيار إجابة) --}}
            <div id="confirm-section-{{$counter}}" class="mt-4 text-center" style="display: none;">
                <button type="button"
                        class="btn btn-success btn-lg px-5"
                        id="confirm-btn-{{$counter}}"
                        onclick="confirmAnswer()">
                    <i class="fas fa-check"></i>
                    تأكيد الإجابة
                    @if($counter < $questioncount - 1)
                        والانتقال للسؤال التالي
                    @else
                        وإنهاء الاختبار
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // متغيرات عالمية للسؤال الحالي
    var selectedAnswer = null;
    var selectedQuestionId = null;

    function selectAnswer(element, questionId, answer) {
        // إزالة التحديد من كل البطاقات في نفس السؤال
        var cards = document.querySelectorAll('.answer-card');
        cards.forEach(function(c) {
            c.classList.remove('border-primary', 'bg-light', 'selected');
            c.style.transform = '';
        });

        // تمييز البطاقة المختارة
        element.classList.add('border-primary', 'bg-light', 'selected');
        element.style.transform = 'scale(1.02)';

        // حفظ الإجابة المختارة
        selectedAnswer = answer;
        selectedQuestionId = questionId;

        // إظهار زر التأكيد
        var confirmSection = document.getElementById('confirm-section-{{$counter}}');
        if (confirmSection) {
            confirmSection.style.display = 'block';
        }
    }

    function confirmAnswer() {
        if (selectedAnswer === null) {
            alert('يرجى اختيار إجابة أولاً');
            return;
        }

        // تعطيل البطاقات لمنع التغيير
        var cards = document.querySelectorAll('.answer-card');
        cards.forEach(function(c) {
            c.style.pointerEvents = 'none';
            c.style.opacity = '0.7';
        });

        // إخفاء زر التأكيد وإظهار مؤشر التحميل
        var btn = document.getElementById('confirm-btn-{{$counter}}');
        if (btn) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جارٍ الحفظ...';
            btn.disabled = true;
        }

        // استدعاء Livewire لإرسال الإجابة
        @this.call('nextQuestion', selectedQuestionId, selectedAnswer);
    }
</script>

<style>
    .answer-card:hover {
        background-color: #f8f9fa !important;
        border-color: #007bff !important;
    }
    .answer-card.selected {
        background-color: #e3f2fd !important;
        border-color: #007bff !important;
        border-width: 2px !important;
    }
    .list-group-item.answer-card {
        border: 2px solid #dee2e6;
        margin-bottom: 8px;
        border-radius: 8px !important;
    }
    .list-group-item.answer-card:hover {
        border-color: #007bff;
    }
</style>
