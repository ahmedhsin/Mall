<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use MongoDB\Driver\Session;
use Nette\Utils\Random;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginFormRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);

    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

}
