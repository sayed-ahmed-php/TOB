<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

    public function index()
    {
        if (Auth::guard('admin')->check())
        {
            return redirect('ar/dashboard');
        }
        return view('dashboard.login');
    }

    public function login()
    {
        if (Auth::guard('admin')->attempt(['email'=>\request('email'), 'password'=>\request('password')])){
            return redirect('admin');
        }
        flashy()->error(__('dashboard.login_fail'));
        return back();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}
