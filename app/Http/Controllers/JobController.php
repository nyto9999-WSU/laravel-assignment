<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;

class JobController extends Controller
{


    public function index()
    {
        // if(auth()->user()->role != 'admin')
        // {
        //     return view('home');
        // }

        // $jobs = Job::all();
        // return view('home', compact('jobs'));
    }


    public function create()
    {
        return view('createJob');
    }


    public function store(Request $request)
    {
        // $attributes = $this->validateJob();
        // auth()->user()->addJob($attributes);

        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        abort_if(auth()->user()->role != "admin", 403);
    }

    protected function validateJob()
    {
        return request()->validate([
            'address' => ['required']
        ]);
    }
}
