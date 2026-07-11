@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    إدخال تقديرات الطلاب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    إدخال تقديرات الطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- اختيار المادة والقسم -->
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">اختر المادة والقسم لعرض الطلاب</h6><br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subject_id">المادة الدراسية : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" id="filter_subject_id" required>
                                            <option selected disabled>حدد المادة الدراسية...</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="filter_section_id">القسم : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" id="filter_section_id" required>
                                            <option selected disabled>حدد القسم...</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->Name_Section }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="evaluation_type">نوع التقدير : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" id="evaluation_type">
                                            <option value="score">درجة رقمية</option>
                                            <option value="text">تقدير نصي</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm" id="load_students_btn">عرض الطلاب</button>
                        </div>
                    </div>

                    <hr>

                    <!-- جدول الطلاب والدرجات (يتم تعبئته عبر AJAX) -->
                    <div class="col-xs-12" id="students_container" style="display: none;">
                        <div class="col-md-12">
                            <form action="{{route('grades.store')}}" method="post" id="grades_form">
                                @csrf
                                <input type="hidden" name="subject_id" id="form_subject_id">
                                <input type="hidden" name="section_id" id="form_section_id">
                                <input type="hidden" name="evaluation_type" id="form_evaluation_type">

                                <div class="form-row mb-3">
                                    <div class="col-md-4">
                                        <label for="term">الفصل الدراسي : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="term" required>
                                            <option value="first">الفصل الأول</option>
                                            <option value="second">الفصل الثاني</option>
                                            <option value="third">الفصل الثالث</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-success">#</th>
                                            <th class="alert-success">اسم الطالب</th>
                                            <th class="alert-success" id="grade_column_header">الدرجة</th>
                                            <th class="alert-success">ملاحظات</th>
                                        </tr>
                                        </thead>
                                        <tbody id="students_tbody">
                                        <!-- يتم تعبئته عبر AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ التقديرات</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('#load_students_btn').on('click', function () {
                var subjectId = $('#filter_subject_id').val();
                var sectionId = $('#filter_section_id').val();
                var evalType = $('#evaluation_type').val();

                if (!subjectId || !sectionId) {
                    alert('يرجى اختيار المادة والقسم أولا');
                    return;
                }

                $.ajax({
                    url: "{{ route('grades.getStudents') }}",
                    type: "GET",
                    data: {
                        subject_id: subjectId,
                        section_id: sectionId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // تحديث نوع عمود التقدير
                        if (evalType === 'text') {
                            $('#grade_column_header').text('التقدير');
                        } else {
                            $('#grade_column_header').text('الدرجة');
                        }

                        // تعيين القيم المخفية في النموذج
                        $('#form_subject_id').val(subjectId);
                        $('#form_section_id').val(sectionId);
                        $('#form_evaluation_type').val(evalType);

                        var tbody = $('#students_tbody');
                        tbody.empty();

                        if (data.students.length === 0) {
                            tbody.append('<tr><td colspan="4" class="alert-danger">لا يوجد طلاب في هذا القسم</td></tr>');
                        } else {
                            $.each(data.students, function (index, student) {
                                var gradeInput = '';
                                if (evalType === 'text') {
                                    gradeInput = '<select class="form-control" name="grade_texts[' + student.id + ']">' +
                                        '<option value="">-- اختر --</option>' +
                                        '<option value="ممتاز" ' + (student.grade_text == 'ممتاز' ? 'selected' : '') + '>ممتاز</option>' +
                                        '<option value="جيد جدا" ' + (student.grade_text == 'جيد جدا' ? 'selected' : '') + '>جيد جدا</option>' +
                                        '<option value="جيد" ' + (student.grade_text == 'جيد' ? 'selected' : '') + '>جيد</option>' +
                                        '<option value="مقبول" ' + (student.grade_text == 'مقبول' ? 'selected' : '') + '>مقبول</option>' +
                                        '<option value="ضعيف" ' + (student.grade_text == 'ضعيف' ? 'selected' : '') + '>ضعيف</option>' +
                                        '</select>';
                                } else {
                                    var scoreVal = student.score !== null ? student.score : '';
                                    gradeInput = '<input type="number" class="form-control" name="scores[' + student.id + ']" min="0" max="100" value="' + scoreVal + '" placeholder="0-100">';
                                }

                                tbody.append(
                                    '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + student.name + '<input type="hidden" name="student_ids[]" value="' + student.id + '"></td>' +
                                    '<td>' + gradeInput + '</td>' +
                                    '<td><input type="text" class="form-control" name="notes[' + student.id + ']" value="' + (student.note || '') + '"></td>' +
                                    '</tr>'
                                );
                            });
                        }

                        $('#students_container').show();
                    },
                    error: function () {
                        alert('حدث خطأ أثناء جلب الطلاب');
                    }
                });
            });
        });
    </script>
@endsection
