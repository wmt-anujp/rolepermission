<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        //
    }

    public function getAdminLogin()
    {
        return view('admin.adminLogin');
    }

    public function adminLogin(Request $request)
    {
        try {
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                return redirect()->route('admin.Dashboard')->with('success', 'Login Successfull');
            } else {
                return redirect()->back()->with('error', 'Please Check Credentials');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary server error.');
        }
    }

    public function getadminDashboard(Request $request)
    {
        $user = User::all();
        return view('admin.adminDashboard', ['users' => $user, 'params' => $request->sorting]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
