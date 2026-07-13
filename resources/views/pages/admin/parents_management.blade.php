@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        إدارة أولياء الأمور والأبناء
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        إدارة أولياء الأمور والأبناء
    @stop
@endsection
@section('content')
    <div class="row">
        {{-- ===== ربط ابن بولي أمر ===== --}}
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-link"></i> ربط طالب بولي أمر
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    <form action="{{ url('/en/admin/parents/link-child') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5">
                                <label><i class="fas fa-user-tie text-primary"></i> ولي الأمر</label>
                                <select name="parent_id" class="form-control" required>
                                    <option value="" selected disabled>اختر ولي الأمر...</option>
                                    @foreach(\App\Models\My_Parent::orderBy('id')->get() as $parent)
                                        <option value="{{ $parent->id }}">
                                            {{ $parent->getTranslation('Name_Father', 'ar') }} — {{ $parent->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label><i class="fas fa-child text-info"></i> الطالب (غير المرتبط)</label>
                                <select name="student_id" class="form-control" required>
                                    <option value="" selected disabled>اختر الطالب...</option>
                                    @foreach($unlinkedStudents as $student)
                                        <option value="{{ $student->id }}">
                                            {{ $student->getTranslation('name', 'ar') }} — {{ $student->email }}
                                            @if($student->grade)
                                                ({{ $student->grade->getTranslation('Name', 'ar') }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-link"></i> ربط
                                </button>
                            </div>
                        </div>
                        @if($unlinkedStudents->isEmpty())
                            <p class="text-muted mt-2"><i class="fas fa-info-circle"></i> لا يوجد طلاب غير مرتبطين حالياً. كل الطلاب لهم أولياء أمور.</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- ===== قائمة أولياء الأمور وأبنائهم ===== --}}
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0" style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-users"></i> قائمة أولياء الأمور وأبنائهم
                    </h5>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif">
                    @foreach($parents as $parent)
                        <div class="card mb-3 border-info">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>
                                            <i class="fas fa-user-tie text-primary"></i>
                                            {{ $parent->getTranslation('Name_Father', 'ar') }}
                                        </strong>
                                        <span class="text-muted">— {{ $parent->email }}</span>
                                        <span class="badge badge-info mr-2">
                                            {{ $parent->students ? $parent->students->count() : 0 }} أبناء
                                        </span>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-info" onclick="toggleChildren({{ $parent->id }})">
                                            <i class="fas fa-eye"></i> عرض الأبناء
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="children-{{ $parent->id }}" style="display: none;">
                                @if($parent->students && $parent->students->isNotEmpty())
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>اسم الطالب</th>
                                                <th>البريد</th>
                                                <th>المرحلة</th>
                                                <th>الصف</th>
                                                <th>القسم</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($parent->students as $child)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $child->getTranslation('name', 'ar') }}</td>
                                                    <td>{{ $child->email }}</td>
                                                    <td>{{ $child->grade ? $child->grade->getTranslation('Name', 'ar') : '-' }}</td>
                                                    <td>{{ $child->classroom ? $child->classroom->getTranslation('Name_Class', 'ar') : '-' }}</td>
                                                    <td>{{ $child->section ? $child->section->getTranslation('Name_Section', 'ar') : '-' }}</td>
                                                    <td>
                                                        <form action="{{ url('/en/admin/parents/unlink-child/' . $child->id) }}" method="post" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('هل أنت متأكد من فصل هذا الطالب عن ولي الأمر؟')">
                                                                <i class="fas fa-unlink"></i> فصل
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted">لا يوجد أبناء مرتبطين بهذا الولي.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center">
                        {{ $parents->links() }}
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
        function toggleChildren(id) {
            var div = document.getElementById('children-' + id);
            div.style.display = (div.style.display === 'none') ? 'block' : 'none';
        }
    </script>
@endsection
