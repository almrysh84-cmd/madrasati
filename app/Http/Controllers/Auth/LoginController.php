<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    //use AuthenticatesUsers;
    use AuthTrait;

    // Note: The 'guest' middleware is intentionally NOT applied here.
    // The default RedirectIfAuthenticated checks ALL guards (web, student,
    // teacher, parent). If a user is logged in as a teacher and tries to
    // access /login/student, the guest middleware redirects them to the
    // teacher dashboard instead of showing the student login form.
    // We handle the "already logged in" check manually in loginForm() so
    // that switching between user types works correctly.

    public function loginForm($type)
    {
        // If the user is already logged in with the SAME guard type they're
        // trying to access, redirect them to their dashboard. Otherwise
        // (e.g. logged in as teacher but accessing student login), show the
        // login form so they can switch.
        if (Auth::guard($type)->check()) {
            return redirect()->intended($this->getRedirectPath($type));
        }

        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    {
        // Log out all other guards before attempting a new login so that
        // switching from one user type to another works cleanly.
        foreach (['web', 'student', 'teacher', 'parent'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return $this->redirect($request);
        }
        else {
            return redirect()->back()->with('message', 'المستخدم اسم او المرور كلمة في عطا توجد');
        }
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get the redirect path for a given guard type.
     */
    protected function getRedirectPath($type)
    {
        switch ($type) {
            case 'student':
                return RouteServiceProvider::STUDENT;
            case 'teacher':
                return RouteServiceProvider::TEACHER;
            case 'parent':
                return RouteServiceProvider::PARENT;
            default:
                return RouteServiceProvider::HOME;
        }
    }


}
