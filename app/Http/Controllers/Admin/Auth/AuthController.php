<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::guard("admin")->logout();

        toastr()->success('Logout Successfully!');

        return redirect()->route("admin.auth.signInView");
    }
}
