<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function __construct(
        private HomeService $homeService = new HomeService()
    ) 
    {}
    public function loginIndex() : View
    {
        return view('login');
    }

    public function registerIndex() : View
    {
        return view('register');
    }

    public function login(Request $request) : Response
    {
        $request->validate([
            'user_id' => ['required', 'string', 'exists:users,user_id'],
            'password' => ['required', 'string']
        ]);
        
        $userId = $request->user_id;
        $password = $request->password;
        $this->homeService->login($userId, $password);

        return response(true);
    }

    public function register(Request $request) : Response
    {
        $request->validate([
            'name' => ['required', 'string'],
            'user_id' => ['required', 'string', 'unique:users,user_id'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string', 'same:password']
        ]);

        $fields = $request->input();
        $this->homeService->register($fields);

        return response(true);
    }

    public function logout() : RedirectResponse
    {
        $this->homeService->logout();
        return redirect()->route('login');
    }
}
