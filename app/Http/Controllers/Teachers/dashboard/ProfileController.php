<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {

        $information = Teacher::findorFail(auth()->user()->id);
        return view('pages.Teachers.dashboard.profile', compact('information'));

    }

    public function update(Request $request, $id)
    {
        // P0-3 fix: IDOR — ignore $id from URL and use the authenticated teacher only
        $information = Teacher::findOrFail(auth()->user()->id);

        $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];

        // P0-8 fix: only update password when a non-empty value is provided
        if (!empty($request->password)) {
            $information->password = Hash::make($request->password);
        }

        $information->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }
}
