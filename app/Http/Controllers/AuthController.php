<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['logout']);
        $this->middleware(['guest'])->only(['showFormLogin', 'login', 'showFormRegister', 'register']);
    }

    public function showFormLogin()
    {
        return view('backend.auth.login');
    }

    public function login(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->validated();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->remember == 'on')) {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->back()->with('warning', 'Please Check your email and password is correct')->withInput($request->only('email', 'remember'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->only('email', 'remember'));
        }

    }

    public function showFormRegister()
    {
        return view('backend.auth.register');
    }

    public function register(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->all();

            $user = User::query()->create($data);
            if ($user) {
                return redirect()->route('login')->with('success', 'register successfully please login');
            }
            return redirect()->back()->with('warning', 'please try again');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }

    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        try {
            Auth::logout();
            return redirect()->route('login');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }
}
