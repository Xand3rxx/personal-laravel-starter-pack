<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;

trait ChangePassword
{
    protected $guards;

    /**
     * Update password of the current request user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeUserPassword(Request $request)
    {
        $user = $this->verifyRequestUser($request);

        $valid = $this->validatePasswordRequest($request);

        return $this->handlePasswordChange($user, $valid);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  App\Models\User $user
     * @param  array  $valid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handlePasswordChange(\App\Models\User $user, array $valid)
    {
        $this->checkPasswordMatch($user, $valid['current_password']);

        $this->setUserPassword($user, $valid['new_password']);

        $this->guard()->login($user);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    /**
     * Validate the Password Update Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validatePasswordRequest(Request $request)
    {
        return $request->validate([
            'current_password'      => 'bail|required|min:8',
            'new_password'          => 'bail|required|min:8',
            'new_confirm_password'  => 'bail|required|same:new_password',
        ]);
    }

    /**
     * Verify Request User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\User $user
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function verifyRequestUser(Request $request)
    {
        if (empty($request->user())) {
            $guards = [null];
            $this->unauthenticated($request, $guards);
        }
        return $request->user();
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'This User is not authenticated.',
            $guards,
            $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        return route('login');
    }

    /**
     * Set the user's password.
     *
     * @param  \App\Models\User $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword(\App\Models\User $user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(\Illuminate\Support\Str::random(60));

        $user->save();
    }

    /**
     * Check if password match
     *
     * @param  App\Models\User $user
     * @param  string  $password
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    protected function checkPasswordMatch(\App\Models\User $user, string $password)
    {
        return Hash::check($password, $user->password)
            ? true
            : back()->withErrors(['current_password' => ['The provided password does not match our records.']]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
