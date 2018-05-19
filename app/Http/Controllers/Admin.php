<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
            return view('admin.dashboard');
    }

    public function meeting()
    {
        return view('admin.meeting');
    }
}
