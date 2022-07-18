<?php

namespace App\Traits;

trait RedirectAuthenticatedUsers
{
    /**
     * Set the redirect url of Authenticated user.
     * Determine redirection based on user role
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return '/' . auth()->user()->role->url ?: '/';
    }
}
