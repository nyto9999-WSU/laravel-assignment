<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Job $job, Order $order)
    {
        $jobAttributes = $this->validateJob();
        $job->update($jobAttributes);

        return (new PagesController)->orderRequested();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
        $order = Order::find($job->order_id);
        abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);

        return view('pages.user.order.showOrder', compact('order', 'job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function validateJob()
    {
        if(isset(request()->start_date))
        {
            $start_date = Carbon::createFromFormat('d-m-Y', request()->start_date)->format('Y-m-d');
            request()->merge(['start_date' => $start_date]);
        }

        request()->merge(['status' => 'assigned']);
        request()->merge(['assigned_at' => now()]);


        return request()->validate([
            'start_date' => ['nullable'],
            'start_time' => ['nullable'],
            'tech_name' => ['nullable'],
            'status' => ['nullable'],
            'assigned_at' => ['nullable'],
        ]);
    }
}
