<div>
    @if(session()->has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    @if(session()->has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- أزرار الأكشن -->
                    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-success btn-sm" wire:click="openCreateModal">
                                <i class="fas fa-plus"></i> إضافة سؤال جديد
                            </button>
                        </div>
                    </div>

                    <!-- نموذج التصفية -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong><i class="fas fa-filter"></i> تصفية الأسئلة</strong>
                        </div>
                        <div class="card-body">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-3">
                                    <label>المادة</label>
                                    <select class="form-control form-control-sm" wire:model="filter_subject">
                                        <option value="">الكل</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>المرحلة</label>
                                    <select class="form-control form-control-sm" wire:model="filter_grade">
                                        <option value="">الكل</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>النوع</label>
                                    <select class="form-control form-control-sm" wire:model="filter_type">
                                        <option value="">الكل</option>
                                        <option value="mcq">اختيار من متعدد</option>
                                        <option value="true_false">صح / خطأ</option>
                                        <option value="essay">مقالي</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>المستوى</label>
                                    <select class="form-control form-control-sm" wire:model="filter_level">
                                        <option value="">الكل</option>
                                        <option value="easy">سهل</option>
                                        <option value="medium">متوسط</option>
                                        <option value="hard">صعب</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- جدول الأسئلة -->
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نص السؤال</th>
                                    <th>النوع</th>
                                    <th>المستوى</th>
                                    <th>الدرجة</th>
                                    <th>المادة</th>
                                    <th>المرحلة</th>
                                    <th>مشترك</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($questions as $question)
                                    <tr>
                                        <td>{{ $questions->firstItem() + $loop->index }}</td>
                                        <td style="text-align: right; max-width: 300px;">{{ \Illuminate\Support\Str::limit($question->getTranslation('question', 'ar'), 80) }}</td>
                                        <td>
                                            @if($question->type == 'mcq')
                                                <span class="badge badge-primary">اختيار من متعدد</span>
                                            @elseif($question->type == 'true_false')
                                                <span class="badge badge-info">صح / خطأ</span>
                                            @else
                                                <span class="badge badge-warning">مقالي</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($question->level == 'easy')
                                                <span class="badge badge-success">سهل</span>
                                            @elseif($question->level == 'medium')
                                                <span class="badge badge-warning">متوسط</span>
                                            @else
                                                <span class="badge badge-danger">صعب</span>
                                            @endif
                                        </td>
                                        <td>{{ $question->score }}</td>
                                        <td>{{ $question->subject ? $question->subject->name : '-' }}</td>
                                        <td>{{ $question->grade ? $question->grade->Name : '-' }}</td>
                                        <td>
                                            @if($question->is_shared)
                                                <span class="badge badge-success">نعم</span>
                                            @else
                                                <span class="badge badge-secondary">لا</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($question->created_by == auth()->user()->id)
                                                <button type="button" class="btn btn-info btn-sm" wire:click="openEditModal({{ $question->id }})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="if(confirm('هل أنت متأكد من حذف هذا السؤال؟')) Livewire.emit('delete', {{ $question->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="text-muted"><i class="fas fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="alert-danger">لا توجد أسئلة في البنك</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- روابط التصفح -->
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- مودال إضافة / تعديل سؤال -->
    @if($showModal)
        <div id="qbModalBackdrop" class="modal-backdrop fade show" style="z-index: 1040;" wire:click.away="showModal = false"></div>
        <div class="modal fade show" style="display: block; z-index: 1050;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editMode ? 'تعديل السؤال' : 'إضافة سؤال جديد' }}</h5>
                        <button type="button" class="close" wire:click="showModal = false" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <label>نص السؤال باللغة العربية <span class="text-danger">*</span></label>
                                <textarea wire:model="question_ar" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col">
                                <label>نص السؤال باللغة الإنجليزية</label>
                                <textarea wire:model="question_en" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label>نوع السؤال <span class="text-danger">*</span></label>
                                <select wire:model="type" class="custom-select mr-sm-2">
                                    <option value="mcq">اختيار من متعدد</option>
                                    <option value="true_false">صح / خطأ</option>
                                    <option value="essay">مقالي</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>مستوى الصعوبة <span class="text-danger">*</span></label>
                                <select wire:model="level" class="custom-select mr-sm-2">
                                    <option value="easy">سهل</option>
                                    <option value="medium">متوسط</option>
                                    <option value="hard">صعب</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>الدرجة <span class="text-danger">*</span></label>
                                <input type="number" wire:model="score" class="form-control" step="0.5" min="0.5" max="100">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label>المادة الدراسية <span class="text-danger">*</span></label>
                                <select wire:model="subject_id" class="custom-select mr-sm-2">
                                    <option selected disabled>حدد المادة...</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>المرحلة الدراسية <span class="text-danger">*</span></label>
                                <select wire:model="grade_id" class="custom-select mr-sm-2">
                                    <option selected disabled>حدد المرحلة...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>

                        @if($type === 'mcq')
                            <div class="card card-body bg-light mb-3">
                                <h6><i class="fas fa-list-ol"></i> خيارات السؤال</h6>
                                @foreach($options as $index => $option)
                                    <div class="form-row mb-2">
                                        <div class="col-10">
                                            <input type="text" wire:model="options.{{ $index }}" class="form-control" placeholder="الخيار {{ $index + 1 }}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger btn-sm" wire:click="removeOption({{ $index }})"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($options) < 6)
                                    <button type="button" class="btn btn-info btn-sm" wire:click="addOption"><i class="fas fa-plus"></i> إضافة خيار</button>
                                @endif
                                <br><br>
                                <label>الإجابة الصحيحة <span class="text-danger">*</span></label>
                                <input type="text" wire:model="correct_answer" class="form-control" placeholder="اكتب الإجابة الصحيحة مطابقة لأحد الخيارات">
                            </div>
                        @elseif($type === 'true_false')
                            <div class="card card-body bg-light mb-3">
                                <h6><i class="fas fa-check-circle"></i> الإجابة الصحيحة</h6>
                                <select wire:model="correct_answer" class="custom-select mr-sm-2">
                                    <option selected disabled>حدد الإجابة الصحيحة...</option>
                                    <option value="صح">صح</option>
                                    <option value="خطأ">خطأ</option>
                                </select>
                            </div>
                        @endif

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="is_shared" id="livewire_is_shared">
                            <label class="form-check-label" for="livewire_is_shared">
                                مشاركة هذا السؤال مع بقية المعلمين في البنك المركزي
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="showModal = false">إلغاء</button>
                        <button type="button" class="btn btn-success" wire:click="save"><i class="fas fa-save"></i> حفظ</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
