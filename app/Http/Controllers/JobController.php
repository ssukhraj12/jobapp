<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jobsView()
    {
        return view('admin.jobs.jobs');
    }
}
