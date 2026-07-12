@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    بنك الأسئلة المركزي
@endsection
@section('page-header')
@endsection
@section('PageTitle')
    بنك الأسئلة المركزي
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

                    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('question_bank.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> إضافة سؤال جديد
                            </a>
                            <a href="{{ route('question_bank.export') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-export"></i> تصدير إلى Excel
                            </a>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#importModal">
                                <i class="fas fa-file-import"></i> استيراد من Excel
                            </button>
                        </div>
                    </div>

                    <!-- ===== أدوات التصفية ===== -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong><i class="fas fa-filter"></i> تصفية الأسئلة</strong>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('question_bank.index') }}" class="row g-2 align-items-end">
                                <div class="col-md-3">
                                    <label>المادة</label>
                                    <select name="subject_id" class="form-control form-control-sm">
                                        <option value="">الكل</option>
                                        @php $teacherSubjects = \App\Models\Subject::where('teacher_id', auth()->user()->id)->get(); @endphp
                                        @foreach($teacherSubjects as $subject)
                                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>المرحلة</label>
                                    <select name="grade_id" class="form-control form-control-sm">
                                        <option value="">الكل</option>
                                        @foreach(\App\Models\Grade::all() as $grade)
                                            <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>النوع</label>
                                    <select name="type" class="form-control form-control-sm">
                                        <option value="">الكل</option>
                                        <option value="mcq" {{ request('type') == 'mcq' ? 'selected' : '' }}>اختيار من متعدد</option>
                                        <option value="true_false" {{ request('type') == 'true_false' ? 'selected' : '' }}>صح / خطأ</option>
                                        <option value="essay" {{ request('type') == 'essay' ? 'selected' : '' }}>مقالي</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>المستوى</label>
                                    <select name="level" class="form-control form-control-sm">
                                        <option value="">الكل</option>
                                        <option value="easy" {{ request('level') == 'easy' ? 'selected' : '' }}>سهل</option>
                                        <option value="medium" {{ request('level') == 'medium' ? 'selected' : '' }}>متوسط</option>
                                        <option value="hard" {{ request('level') == 'hard' ? 'selected' : '' }}>صعب</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-warning btn-sm w-100">
                                        <i class="fas fa-search"></i> تصفية
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نص السؤال</th>
                                    <th>النوع</th>
                                    <th>المستوى</th>
                                    <th>الدرجة</th>
                                    <th>المادة</th>
                                    <th>المرحلة</th>
                                    <th>أنشأها</th>
                                    <th>مشترك</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: right; max-width: 300px;">{{ \Illuminate\Support\Str::limit($question->getTranslation('question', 'ar'), 80) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $question->type_color }}">{{ $question->type_text }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $question->level_color }}">{{ $question->level_text }}</span>
                                        </td>
                                        <td>{{ $question->score }}</td>
                                        <td>{{ $question->subject ? $question->subject->name : '-' }}</td>
                                        <td>{{ $question->grade ? $question->grade->Name : '-' }}</td>
                                        <td>{{ $question->creator ? $question->creator->Name : '-' }}</td>
                                        <td>
                                            @if($question->is_shared)
                                                <span class="badge badge-success">نعم</span>
                                            @else
                                                <span class="badge badge-secondary">لا</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($question->created_by == auth()->user()->id)
                                                <a href="{{ route('question_bank.edit', $question->id) }}" class="btn btn-info btn-sm" title="تعديل">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_qb{{ $question->id }}" title="حذف">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="text-muted"><i class="fas fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal: حذف -->
                                    <div class="modal fade" id="delete_qb{{ $question->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('question_bank.destroy', $question->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">حذف السؤال</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من حذف السؤال التالي؟</p>
                                                        <p class="text-danger"><strong>{{ \Illuminate\Support\Str::limit($question->getTranslation('question', 'ar'), 100) }}</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="10" class="alert-danger">لا توجد أسئلة في البنك</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: استيراد من Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('question_bank.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-file-import"></i> استيراد أسئلة من Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>اختر ملف Excel أو CSV يحتوي على الأسئلة بالصيغة التالية:</p>
                        <ul class="text-muted small">
                            <li>الأعمدة المطلوبة: type, level, score, subject, grade, options, correct_answer</li>
                            <li>أو الأعمدة العربية: النوع, المستوى, الدرجة, المادة, المرحلة, الخيارات, الإجابة_الصحيحة</li>
                            <li>الخيارات تُفصل بينها بعلامة |</li>
                            <li>أنواع الأسئلة: اختيار من متعدد، صح/خطأ، مقالي</li>
                            <li>المستويات: سهل، متوسط، صعب</li>
                        </ul>
                        <div class="form-group">
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-upload"></i> استيراد</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
