@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        محادثة مع {{ $teacher->getTranslation('name', 'ar') }}
    @stop
@endsection
@section('page-header')
    @section('PageTitle')
        محادثة مع {{ $teacher->getTranslation('name', 'ar') }}
    @stop
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-header bg-primary text-white">
                    <a href="{{ route('parent.messages.index') }}" class="btn btn-sm btn-light ml-2">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                    <span style="font-family: 'Cairo', sans-serif">
                        <i class="fas fa-chalkboard-teacher"></i>
                        محادثة مع المعلم: {{ $teacher->getTranslation('name', 'ar') }}
                    </span>
                </div>
                <div class="card-body" style="font-family: 'Cairo', sans-serif; min-height: 400px;">
                    {{-- ===== الرسائل ===== --}}
                    <div id="messages-container" style="max-height: 500px; overflow-y: auto; padding: 10px; background-color: #f5f5f5; border-radius: 8px;">
                        @forelse($messages as $msg)
                            @php
                                $isMine = ($msg->sender_type === 'parent' && $msg->sender_id == auth()->user()->id);
                            @endphp
                            <div class="d-flex mb-3 {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="card {{ $isMine ? 'bg-primary text-white' : 'bg-white' }}"
                                     style="max-width: 70%; border-radius: 12px;">
                                    <div class="card-body p-3">
                                        <p class="mb-1">{{ $msg->body }}</p>
                                        <small class="{{ $isMine ? 'text-light' : 'text-muted' }}">
                                            {{ $msg->created_at->format('Y-m-d H:i') }}
                                            @if($msg->student)
                                                <br>بخصوص: {{ $msg->student->getTranslation('name', 'ar') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-comments fa-3x mb-3"></i>
                                <p>لا توجد رسائل بعد. ابدأ المحادثة!</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- ===== نموذج إرسال رسالة ===== --}}
                    <hr>
                    <form action="{{ route('parent.messages.store', $teacher->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-2">
                                <label><i class="fas fa-child text-info"></i> بخصوص ابنك (اختياري)</label>
                                <select name="student_id" class="form-control">
                                    <option value="">— عام (ليس لابن محدد) —</option>
                                    @foreach($children as $child)
                                        <option value="{{ $child->id }}" @if($student && $student->id == $child->id) selected @endif>
                                            {{ $child->getTranslation('name', 'ar') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8 mb-2">
                                <label><i class="fas fa-keyboard text-primary"></i> رسالتك</label>
                                <textarea name="body" class="form-control" rows="2"
                                          placeholder="اكتب رسالتك هنا..." required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                            <i class="fas fa-paper-plane"></i> إرسال
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
        // scroll to bottom of messages
        var container = document.getElementById('messages-container');
        if (container) container.scrollTop = container.scrollHeight;
    </script>
@endsection
