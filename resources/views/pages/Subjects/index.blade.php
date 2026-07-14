@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        قائمة المواد الدراسية
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        قائمة المواد الدراسية
    @stop
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body" style="font-family: 'Cairo', sans-serif">

                    {{-- ===== فلاتر الصف والفصل ===== --}}
                    <div class="card border-info mb-4">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-filter"></i> تصفية المواد حسب الصف والفصل الدراسي
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('subjects.index') }}" class="form-inline">
                                <div class="form-group ml-2 mb-2">
                                    <label class="ml-2">الصف الدراسي:</label>
                                    <select name="classroom_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">— كل الصفوف —</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}"
                                                @if((string)$classroom_id === (string)$classroom->id) selected @endif>
                                                {{ $classroom->Grades ? $classroom->Grades->getTranslation('Name', 'ar') : '' }}
                                                — {{ $classroom->getTranslation('Name_Class', 'ar') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ml-3 mb-2">
                                    <label class="ml-2">الفصل الدراسي:</label>
                                    <select name="term" class="form-control" onchange="this.form.submit()">
                                        <option value="">— كلا الفصلين —</option>
                                        <option value="1" @if($term === '1') selected @endif>الفصل الأول</option>
                                        <option value="2" @if($term === '2') selected @endif>الفصل الثاني</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info btn-sm ml-3 mb-2">
                                    <i class="fas fa-search"></i> تصفية
                                </button>
                                <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm ml-1 mb-2">
                                    <i class="fas fa-times"></i> إلغاء
                                </a>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm mb-3">
                        <i class="fas fa-plus"></i> إضافة مادة جديدة
                    </a>

                    @if($classroom_id || $term)
                        <div class="alert alert-info py-2 mb-3">
                            <i class="fas fa-info-circle"></i>
                            عرض
                            @if($classroom_id)
                                <strong>
                                    @php
                                        $selectedClassroom = $classrooms->firstWhere('id', (int)$classroom_id);
                                    @endphp
                                    {{ $selectedClassroom ? $selectedClassroom->getTranslation('Name_Class', 'ar') : '' }}
                                </strong>
                            @else
                                <strong>كل الصفوف</strong>
                            @endif
                            —
                            @if($term === '1')
                                <strong>الفصل الأول</strong>
                            @elseif($term === '2')
                                <strong>الفصل الثاني</strong>
                            @else
                                <strong>كلا الفصلين</strong>
                            @endif
                            ({{ $subjects->total() }} مادة)
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-sm table-bordered p-0"
                               data-page-length="50" style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المادة</th>
                                <th>المرحلة الدراسية</th>
                                <th>الصف الدراسي</th>
                                <th>الفصل</th>
                                <th>اسم المعلم</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subjects as $subject)
                                <tr>
                                    <td>{{ $subjects->firstItem() + $loop->index }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->grade ? $subject->grade->Name : "-" }}</td>
                                    <td>{{ $subject->classroom ? $subject->classroom->Name_Class : "-" }}</td>
                                    <td>
                                        @if($subject->term == 1)
                                            <span class="badge badge-primary">الفصل الأول</span>
                                        @else
                                            <span class="badge badge-success">الفصل الثاني</span>
                                        @endif
                                    </td>
                                    <td>{{ $subject->teacher ? $subject->teacher->name : "-" }}</td>
                                    <td>
                                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete_subject{{ $subject->id }}" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- Delete modal --}}
                                <div class="modal fade" id="delete_subject{{ $subject->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تأكيد الحذف</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>هل أنت متأكد من حذف مادة: <strong>{{ $subject->name }}</strong>؟</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                                        <p>لا توجد مواد مطابقة للتصفية. اختر صفًا وفصلاً دراسيًا.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $subjects->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
