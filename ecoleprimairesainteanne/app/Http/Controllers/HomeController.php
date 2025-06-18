<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only authenticated users can access dashboard
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // We'll implement dashboard logic later
        return view('dashboard');
    }
}
