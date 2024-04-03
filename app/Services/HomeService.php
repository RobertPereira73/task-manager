<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Throw_;

class HomeService
{
    public function login(string $userId, string $password) : void
    {   
        $user = User::userByUserId($userId)->firstOrFail();
        if (!$this->validateCredentials($user, $password)) {
            throw ValidationException::withMessages(['password' => 'Incorrect password!']);
        }

        auth()->login($user);
    }

    public function register(array $fields) : void
    {
        $user = User::create($fields);
        $this->login($user->user_id, $fields['password']);
    }

    public function logout() : void
    {
        Session::flush();
        Auth::logout();
    }

    public function validateCredentials(User $user, string $password) : bool
    {
        return Hash::check($password, $user->password);
    }
}
