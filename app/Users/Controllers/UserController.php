<?php

namespace App\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        return view('pages/login');
    }
    public function register()
    {
        return view('pages/register');
    }

    public function index(Request $request)
    {
        return view('pages/users');
    }

    public function show(Request $request)
    {
        return view();
    }

    public function edit(Request $request)
    {
        return view();
    }

    public function update(Request $request)
    {
        return view();
    }

    public function destroy(Request $request)
    {

    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function register(Request $request)
    {
        return view('register');
    }

}
