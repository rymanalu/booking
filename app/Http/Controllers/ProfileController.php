<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin,user');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user();

        $isUser = isset($user->email);

        return view('profile', compact('user', 'isUser'));
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->except('_token', 'password', 'password_confirmation');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $result = user()->update($data);

        if ($result) {
            flash()->success('Profile successfully updated!');
        } else {
            flash()->error('Profile failed to update!');
        }

        return redirect()->route('profile.index');
    }
}
