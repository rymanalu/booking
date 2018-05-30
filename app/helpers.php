<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('user')) {
    /**
     * Get the authenticated user instance.
     *
     * @return \App\Admin|\App\User
     */
    function user()
    {
        $user = Auth::guard('admin')->user();

        if (is_null($user)) {
            return Auth::guard('user')->user();
        }

        return $user;
    }
}
