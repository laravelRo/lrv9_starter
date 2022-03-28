<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginStafRequest;

class AuthController extends Controller
{
    //formularul de logare pentru staff
    public function loginStaff()
    {
        return view('staff.forms.login');
    }

    public function authStaff(LoginStafRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->session()->flash('swalLoginStaff', 'Logare reusita');

        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended(route('staf.cpanel'));
    }

    public function logoutStaff(Request $request)
    {
        Auth::guard('staf')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function viewCpanel()
    {
        return view('staff.cpanel');
    }
}
