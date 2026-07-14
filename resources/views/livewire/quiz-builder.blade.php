<div style="font-family: 'Cairo', sans-serif;">
    {{-- ===== إعدادات الاختبار ===== --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-cog"></i> إعدادات الاختبار</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label>المدة (دقيقة)</label>
                    <input type="number" wire:model="duration_minutes" class="form-control" min="1" max="300">
                </div>
                <div class="col-md-3 mb-2">
                    <label>درجة النجاح (%)</label>
                    <input type="number" wire:model="passing_score" class="form-control" min="0" max="100">
                </div>
                <div class="col-md-3 mb-2">
                    <label>عدد المحاولات</label>
                    <input type="number" wire:model="max_attempts" class="form-control" min="1" max="10">
                </div>
                <div class="col-md-3 mb-2 d-flex align-items-end">
                    <button wire:click="saveSettings" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> حفظ الإعدادات
                    </button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" wire:model="shuffle_questions" class="form-check-input" id="sq">
                        <label for="sq" class="form-check-label">ترتيب عشوائي للأسئلة</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" wire:model="shuffle_options" class="form-check-input" id="so">
                        <label for="so" class="form-check-label">ترتيب عشوائي للخيارات</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" wire:model="show_results_immediately" class="form-check-input" id="sr">
                        <label for="sr" class="form-check-label">إظهار النتيجة فوراً</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" wire:model="anti_cheat" class="form-check-input" id="ac">
                        <label for="ac" class="form-check-label">مضاد الغش (كشف تبديل التبويب)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== إضافة سؤال جديد ===== --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle"></i> إضافة سؤال جديد</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label>نص السؤال *</label>
                    <textarea wire:model="title" class="form-control" rows="2" placeholder="اكتب نص السؤال هنا..."></textarea>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label>نوع السؤال</label>
                    <select wire:model="question_type" class="form-control">
                        <option value="mcq_single">اختيار من متعدد (إجابة واحدة)</option>
                        <option value="mcq_multiple">اختيار من متعدد (إجابات متعددة)</option>
                        <option value="true_false">صح / خطأ</option>
                        <option value="fill_blank">أكمل الفراغ</option>
                        <option value="essay">سؤال مقالي</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label>الدرجة</label>
                    <input type="number" wire:model="score" class="form-control" min="0.5" step="0.5">
                </div>
                <div class="col-md-4 mb-2">
                    <label>مستوى الصعوبة</label>
                    <select wire:model="difficulty" class="form-control">
                        <option value="easy">سهل</option>
                        <option value="medium">متوسط</option>
                        <option value="hard">صعب</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label>شرح الإجابة (اختياري)</label>
                    <input type="text" wire:model="explanation" class="form-control" placeholder="يظهر للطالب بعد التصحيح">
                </div>
            </div>

            {{-- خيارات حسب نوع السؤال --}}
            @if(in_array($question_type, ['mcq_single', 'mcq_multiple']))
                <hr>
                <label><strong>الخيارات:</strong></label>
                @foreach($options as $index => $option)
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text {{ $correct_option == $index ? 'bg-success text-white' : 'bg-light' }}">
                                <input type="radio" wire:model="correct_option" value="{{ $index }}" id="corr_{{ $index }}">
                                <label for="corr_{{ $index }}" class="mb-0 ml-1">{{ chr(65 + $index) }}</label>
                            </span>
                        </div>
                        <input type="text" wire:model="options.{{ $index }}" class="form-control" placeholder="الخيار {{ chr(65 + $index) }}">
                        @if(count($options) > 1)
                            <div class="input-group-append">
                                <button wire:click="removeOption({{ $index }})" class="btn btn-danger"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                    </div>
                @endforeach
                <button wire:click="addOption" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> إضافة خيار</button>
                <small class="text-muted d-block mt-1">اضغط على الزر الدائري بجانب الخيار لتحديده كإجابة صحيحة (أخضر).</small>
            @endif

            @if($question_type === 'true_false')
                <hr>
                <label>الإجابة الصحيحة:</label>
                <div class="form-check form-check-inline">
                    <input type="radio" wire:model="true_false_answer" value="صح" class="form-check-input" id="tf_t">
                    <label for="tf_t" class="form-check-label">صح</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" wire:model="true_false_answer" value="خطأ" class="form-check-input" id="tf_f">
                    <label for="tf_f" class="form-check-label">خطأ</label>
                </div>
            @endif

            @if($question_type === 'fill_blank')
                <hr>
                <label>الإجابات الصحيحة (افصل بينها بـ |):</label>
                <input type="text" wire:model="fill_blank_answers" class="form-control" placeholder="مثال: الرياض|عاصمة اليمن">
                <small class="text-muted">يمكنك إدخال عدة إجابات مقبولة مفصولة بـ |</small>
            @endif

            @if($question_type === 'essay')
                <hr>
                <label>الإجابة النموذجية (للمعلم — لن تظهر للطالب):</label>
                <textarea wire:model="essay_answer" class="form-control" rows="3" placeholder="اكتب الإجابة النموذجية هنا..."></textarea>
                <small class="text-muted">الأسئلة المقالية تحتاج تصحيح يدوي من المعلم.</small>
            @endif

            <hr>
            <button wire:click="saveQuestion" wire:loading.attr="disabled" class="btn btn-success btn-lg w-100">
                <span wire:loading><i class="fas fa-spinner fa-spin"></i> جارٍ الحفظ...</span>
                <span wire:loading.remove><i class="fas fa-save"></i> حفظ السؤال</span>
            </button>
        </div>
    </div>

    {{-- ===== قائمة الأسئلة ===== --}}
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-list"></i> الأسئلة ({{ $questions->count() }})</h5>
        </div>
        <div class="card-body">
            @if($questions->isEmpty())
                <p class="text-muted text-center py-3"><i class="fas fa-info-circle"></i> لا توجد أسئلة بعد. أضف أول سؤال أعلاه!</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="alert-info">
                                <th>#</th>
                                <th>السؤال</th>
                                <th>النوع</th>
                                <th>الدرجة</th>
                                <th>الصعوبة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $q)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ mb_substr($q->title, 0, 80) }}{{ mb_strlen($q->title) > 80 ? '...' : '' }}</td>
                                    <td>
                                        @php
                                            $types = [
                                                'mcq_single'   => '<span class="badge badge-primary">اختيار واحد</span>',
                                                'mcq_multiple' => '<span class="badge badge-info">اختيار متعدد</span>',
                                                'true_false'   => '<span class="badge badge-success">صح/خطأ</span>',
                                                'fill_blank'   => '<span class="badge badge-warning">أكمل الفراغ</span>',
                                                'essay'        => '<span class="badge badge-danger">مقالي</span>',
                                            ];
                                        @endphp
                                        {!! $types[$q->question_type] ?? $q->question_type !!}
                                    </td>
                                    <td>{{ $q->score }}</td>
                                    <td>
                                        @if($q->difficulty === 'easy') <span class="badge badge-success">سهل</span>
                                        @elseif($q->difficulty === 'medium') <span class="badge badge-warning">متوسط</span>
                                        @else <span class="badge badge-danger">صعب</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="deleteQuestion({{ $q->id }})"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')"
                                                class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
