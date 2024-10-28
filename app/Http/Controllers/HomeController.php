<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Jobcat;
use App\Models\Jobtype;
use App\Models\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobcats = Jobcat::count();
        $jobtypes = Jobtype::count();
        $jobs = Job::count();
        $users = User::count();

        return view('home',compact('jobcats','jobtypes','jobs','users'));
    }
}
