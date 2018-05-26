<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->get('username');

        if (str_contains($username, '@')) {
            return $this->loginUser($request);
        }

        return $this->loginAdmin($request);
    }

    protected function loginAdmin(LoginRequest $request)
    {
        //
    }

    protected function loginUser(LoginRequest $request)
    {
        //
    }
}
