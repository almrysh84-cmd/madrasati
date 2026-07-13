<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\My_Parent;
use App\Models\Student;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherMessagesController extends Controller
{
    /**
     * عرض قائمة المحادثات (كل أولياء الأمور الذين راسلوا هذا المعلم)
     */
    public function index()
    {
        $teacherId = auth()->user()->id;

        // كل أولياء الأمور الذين راسلوا هذا المعلم (أو راسلهم)
        $parentIds = Message::where(function ($q) use ($teacherId) {
            $q->where('sender_type', 'teacher')->where('sender_id', $teacherId)
              ->where('receiver_type', 'parent');
        })->orWhere(function ($q) use ($teacherId) {
            $q->where('sender_type', 'parent')
              ->where('receiver_type', 'teacher')->where('receiver_id', $teacherId);
        })->pluck('sender_type' === 'parent' ? 'sender_id' : 'receiver_id')
          ->merge(
              Message::where('sender_type', 'parent')
                  ->where('receiver_type', 'teacher')
                  ->where('receiver_id', $teacherId)
                  ->pluck('sender_id')
          )
          ->unique();

        $parents = My_Parent::whereIn('id', $parentIds)->get();

        // عدد الرسائل غير المقروءة من كل ولي أمر
        $unreadCounts = Message::where('receiver_type', 'teacher')
            ->where('receiver_id', $teacherId)
            ->whereNull('read_at')
            ->select('sender_id', DB::raw('count(*) as cnt'))
            ->groupBy('sender_id')
            ->pluck('cnt', 'sender_id');

        return view('pages.Teachers.dashboard.messages.index', compact('parents', 'unreadCounts'));
    }

    /**
     * عرض محادثة مع ولي أمر محدد
     */
    public function show($parentId)
    {
        $teacherId = auth()->user()->id;
        $parent = My_Parent::findOrFail($parentId);

        $messages = Message::where(function ($q) use ($parentId, $teacherId) {
            $q->where('sender_type', 'parent')->where('sender_id', $parentId)
              ->where('receiver_type', 'teacher')->where('receiver_id', $teacherId);
        })->orWhere(function ($q) use ($parentId, $teacherId) {
            $q->where('sender_type', 'teacher')->where('sender_id', $teacherId)
              ->where('receiver_type', 'parent')->where('receiver_id', $parentId);
        })->orderBy('created_at', 'asc')->get();

        // تحديد رسائل ولي الأمر كمقروءة
        Message::where('sender_type', 'parent')
            ->where('sender_id', $parentId)
            ->where('receiver_type', 'teacher')
            ->where('receiver_id', $teacherId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('pages.Teachers.dashboard.messages.show', compact('parent', 'messages'));
    }

    /**
     * إرسال رد على رسالة ولي أمر
     */
    public function store(Request $request, $parentId)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ], [
            'body.required' => 'يرجى كتابة نص الرسالة',
        ]);

        $teacherId = auth()->user()->id;
        $parent = My_Parent::findOrFail($parentId);

        $message = Message::create([
            'sender_type'   => 'teacher',
            'sender_id'     => $teacherId,
            'receiver_type' => 'parent',
            'receiver_id'   => $parentId,
            'student_id'    => null,
            'body'          => $request->body,
        ]);

        // إرسال إشعار لولي الأمر
        $teacherName = auth()->user()->getTranslation('name', 'ar');
        $conversationUrl = '/en/parent_messages/' . $teacherId;

        $parent->notify(new NewMessageNotification(
            $teacherName,
            $request->body,
            null,
            $conversationUrl
        ));

        toastr()->success('تم إرسال الرسالة');
        return redirect()->back();
    }
}
