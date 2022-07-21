<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSignup()
    {
        return view('user.userRegister');
    }
    public function userSignup(Request $request)
    {
        try {
            $profile = $this->imageUpload($request, 'profile', 'profile');
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo' => $profile,
            ]);
            Auth::guard('user')->login($user);
            return redirect()->route('user.Feed')->with('success', 'Signup Successfull');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary Server Error.');
        }
    }
    public function userLogin(Request $request)
    {
        try {
            if (Auth::guard('user')->attempt($request->only('email', 'password'))) {
                $userstatus = Auth::guard('user')->user()->active_status;
                if ($userstatus === 1) {
                    return redirect()->route('user.Feed')->with('success', __('message.Loginsuccess'));
                } else {
                    Auth::guard('user')->logout();
                    return redirect()->route('user.Login')->with('error', 'Your account is Inactive');
                }
            } else {
                return back()->with('error', 'Please Check Credentials');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary Server Error.');
        }
    }
    public function userFeed(Request $request)
    {
        $userdata = User::with('languages')->where('id', Auth::guard('user')->user()->id)->get();
        return view('user.userFeed', ['params' => $request->sorting, 'user' => $userdata]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
