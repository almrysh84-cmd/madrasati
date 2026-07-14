<div style="font-family: 'Cairo', sans-serif;">
    @if(!$started && !$finished)
        {{-- ===== شاشة بدء الاختبار ===== --}}
        <div class="card shadow-sm" style="max-width: 700px; margin: 0 auto;">
            <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="mb-0"><i class="fas fa-file-alt"></i> {{ $quiz->getTranslation('name', 'ar') }}</h4>
            </div>
            <div class="card-body text-center py-5">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <i class="fas fa-question-circle text-primary fa-2x"></i>
                            <h4 class="mt-2">{{ $quiz->questions->count() }}</h4>
                            <small class="text-muted">سؤال</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <i class="fas fa-clock text-warning fa-2x"></i>
                            <h4 class="mt-2">{{ $quiz->duration_minutes ?? '∞' }}</h4>
                            <small class="text-muted">دقيقة</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <i class="fas fa-star text-success fa-2x"></i>
                            <h4 class="mt-2">{{ $quiz->passing_score }}%</h4>
                            <small class="text-muted">درجة النجاح</small>
                        </div>
                    </div>
                </div>

                @if($quiz->max_attempts > 1)
                    <p class="text-muted">عدد المحاولات المسموح: {{ $quiz->max_attempts }}</p>
                @endif
                @if($quiz->anti_cheat)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>تنبيه:</strong> نظام مضاد للغش مُفعّل. تبديل التبويب سيُسجَّل وقد يُلغي اختبارك.
                    </div>
                @endif

                <button wire:click="startQuiz" class="btn btn-success btn-lg px-5 mt-3">
                    <i class="fas fa-play"></i> بدء الاختبار
                </button>
            </div>
        </div>

    @elseif($started && !$finished)
        {{-- ===== أثناء الاختبار ===== --}}
        {{-- شريط التقدم + المؤقت --}}
        <div class="card shadow-sm mb-3" style="max-width: 800px; margin: 0 auto;">
            <div class="card-body py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge badge-primary">
                            السؤال {{ $currentQuestionIndex + 1 }} من {{ $questions->count() }}
                        </span>
                    </div>
                    <div>
                        @if($quiz->duration_minutes)
                            <span class="badge badge-warning badge-lg" id="timer-display" style="font-size: 18px;">
                                <i class="fas fa-clock"></i> {{ $this->remainingTimeAttribute }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="progress mt-2" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: {{ (($currentQuestionIndex + 1) / $questions->count()) * 100 }}%"></div>
                </div>
            </div>
        </div>

        {{-- السؤال الحالي --}}
        @php $question = $questions[$currentQuestionIndex]; @endphp
        <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between">
                    <span class="badge badge-{{ $question->difficulty == 'easy' ? 'success' : ($question->difficulty == 'hard' ? 'danger' : 'warning') }}">
                        @if($question->difficulty == 'easy') سهل @elseif($question->difficulty == 'hard') صعب @else متوسط @endif
                    </span>
                    <span class="badge badge-info">الدرجة: {{ $question->score }}</span>
                </div>
            </div>
            <div class="card-body py-4">
                <h5 class="mb-4">{{ $question->title }}</h5>

                @if($question->question_type == 'mcq_single')
                    {{-- اختيار واحد --}}
                    @php
                        $options = $question->options_json ?? explode(' - ', $question->answers);
                        if(is_string($options)) $options = json_decode($options, true) ?? explode(' - ', $question->answers);
                    @endphp
                    @foreach($options as $idx => $opt)
                        <div class="form-check mb-2 p-3 border rounded {{ ($selectedOptions[$question->id][0] ?? -1) == $idx ? 'border-primary bg-light' : '' }}" style="cursor: pointer;"
                             wire:click="$set('selectedOptions.{{ $question->id }}', [{{ $idx }}])">
                            <input type="radio" class="form-check-input" {{ ($selectedOptions[$question->id][0] ?? -1) == $idx ? 'checked' : '' }} disabled>
                            <label class="form-check-label ml-2" style="font-size: 16px;">
                                <span class="badge badge-primary">{{ chr(65 + $idx) }}</span>
                                {{ $opt }}
                            </label>
                        </div>
                    @endforeach

                @elseif($question->question_type == 'mcq_multiple')
                    {{-- اختيار متعدد --}}
                    @php
                        $options = $question->options_json ?? explode(' - ', $question->answers);
                        if(is_string($options)) $options = json_decode($options, true) ?? explode(' - ', $question->answers);
                    @endphp
                    @foreach($options as $idx => $opt)
                        <div class="form-check mb-2 p-3 border rounded" style="cursor: pointer;"
                             wire:click="toggleMultiOption({{ $question->id }}, {{ $idx }})">
                            <input type="checkbox" class="form-check-input"
                                {{ in_array($idx, $selectedOptions[$question->id] ?? []) ? 'checked' : '' }} disabled>
                            <label class="form-check-label ml-2" style="font-size: 16px;">
                                <span class="badge badge-info">{{ chr(65 + $idx) }}</span>
                                {{ $opt }}
                            </label>
                        </div>
                    @endforeach

                @elseif($question->question_type == 'true_false')
                    {{-- صح/خطأ --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-success p-4 text-center" style="cursor: pointer;"
                                 wire:click="$set('answers.{{ $question->id }}', 'صح')"
                                 style="{{ ($answers[$question->id] ?? '') == 'صح' ? 'background-color: #d4edda;' : '' }}">
                                <i class="fas fa-check-circle text-success fa-3x"></i>
                                <h4 class="mt-2 mb-0">صح</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-danger p-4 text-center" style="cursor: pointer;"
                                 wire:click="$set('answers.{{ $question->id }}', 'خطأ')"
                                 style="{{ ($answers[$question->id] ?? '') == 'خطأ' ? 'background-color: #f8d7da;' : '' }}">
                                <i class="fas fa-times-circle text-danger fa-3x"></i>
                                <h4 class="mt-2 mb-0">خطأ</h4>
                            </div>
                        </div>
                    </div>

                @elseif($question->question_type == 'fill_blank')
                    {{-- أكمل الفراغ --}}
                    <input type="text" wire:model.lazy="answers.{{ $question->id }}" class="form-control form-control-lg"
                           placeholder="اكتب إجابتك هنا...">
                    <small class="text-muted">اكتب إجابتك ثم اضغط التالي.</small>

                @elseif($question->question_type == 'essay')
                    {{-- مقالي --}}
                    <textarea wire:model.lazy="answers.{{ $question->id }}" class="form-control" rows="6"
                              placeholder="اكتب إجابتك المقالية هنا..."></textarea>
                    <small class="text-muted">سيتم تصحيح هذا السؤال يدوياً من قبل المعلم.</small>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button wire:click="prevQuestion" class="btn btn-secondary"
                        @if($currentQuestionIndex == 0) disabled @endif>
                    <i class="fas fa-arrow-right"></i> السابق
                </button>
                @if($currentQuestionIndex < $questions->count() - 1)
                    <button wire:click="nextQuestion" class="btn btn-primary">
                        التالي <i class="fas fa-arrow-left"></i>
                    </button>
                @else
                    <button wire:click="submitQuiz" class="btn btn-success"
                            onclick="return confirm('هل أنت متأكد من تسليم الاختبار؟')">
                        <i class="fas fa-check"></i> تسليم الاختبار
                    </button>
                @endif
            </div>
        </div>

    @elseif($finished && $result)
        {{-- ===== شاشة النتيجة ===== --}}
        <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header {{ $result->passed ? 'bg-success' : 'bg-danger' }} text-white text-center py-4">
                <h3 class="mb-0">
                    @if($result->passed) 🎉 نجحت! @else 📚 لم تنجح @endif
                </h3>
            </div>
            <div class="card-body text-center py-5">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <h2 class="text-primary">{{ $result->score }}</h2>
                            <small class="text-muted">درجتك</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <h2 class="text-success">{{ $result->percentage }}%</h2>
                            <small class="text-muted">النسبة</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <h2 class="text-warning">{{ $result->max_score }}</h2>
                            <small class="text-muted">الدرجة الكاملة</small>
                        </div>
                    </div>
                </div>

                @if($quiz->anti_cheat && $result->tab_switches > 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        تم تسجيل {{ $result->tab_switches }} تبديل تبويب أثناء الاختبار.
                    </div>
                @endif

                <a href="{{ url('/en/student_exams') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-arrow-right"></i> رجوع للاختبارات
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    // مؤقت العد التنازلي
    window.addEventListener('quiz-started', event => {
        let seconds = event.detail.seconds;
        const timerEl = document.getElementById('timer-display');

        const interval = setInterval(() => {
            if (seconds <= 0) {
                clearInterval(interval);
                @this.call('submitQuiz');
                return;
            }
            seconds--;
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            if (timerEl) {
                timerEl.innerHTML = '<i class="fas fa-clock"></i> ' +
                    String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
                if (seconds < 60) timerEl.style.background = '#dc3545';
            }
        }, 1000);

        // مضاد الغش: كشف تبديل التبويب
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                @this.call('recordTabSwitch');
            }
        });
    });
</script>
