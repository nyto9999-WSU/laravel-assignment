<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JobController extends Controller
{

    public function currentJobSearch(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        $jobs = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
            ->select('jobs.*', 'orders.name')
            ->where('model_number', 'like', "%$query%")
            ->orWhere('serial_number', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('jobs.id', '=', $query)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $jobs->appends(['query' => $query]);
        return view('pages.admin.order.currentOrder', compact(['jobs', 'query']));
    }

    public function assignedJobSearch(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        $jobs = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
            ->select('jobs.*', 'orders.name')
            ->where('model_number', 'like', "%$query%")
            ->orWhere('serial_number', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('tech_name', 'like', "%$query%")
            ->orWhere('jobs.id', '=', $query)
            ->orderBy('assigned_at', 'desc')
            ->paginate(10);

        $jobs->appends(['query' => $query]);
        return view('pages.admin.order.assignedOrder', compact(['jobs', 'query']));
    }

    public function completedJobSearch(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        $jobs = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
            ->select('jobs.*', 'orders.name')
            ->where('model_number', 'like', "%$query%")
            ->orWhere('serial_number', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('tech_name', 'like', "%$query%")
            ->orWhere('jobs.id', '=', $query)
            ->orderBy('end_date', 'desc')
            ->paginate(10);
        $jobs->appends(['query' => $query]);
        return view('pages.admin.order.completedOrder', compact(['jobs', 'query']));
    }

    public function customerJobSearch(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];

        $jobs = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
            ->select('jobs.*', 'orders.name', 'orders.user_id')
            ->where('model_number', 'like', "%$query%")
            ->orWhere('serial_number', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('tech_name', 'like', "%$query%")
            ->orWhere('jobs.id', '=', $query)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $jobs->appends(['query' => $query]);
        return view('pages.user.order.currentOrder', compact(['jobs', 'query']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /* Assign button in Assign job to technician */
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
    {}

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
        if (isset(request()->start_date)) {
            $start_date = Carbon::createFromFormat('d-m-Y', request()->start_date)->format('Y-m-d');
            request()->merge(['start_date' => $start_date]);
        }

        request()->merge(['status' => 'assigned']);
        request()->merge(['assigned_at' => now()]);

        return request()->validate([
            'start_date' => 'required|',
            'start_time' => 'required|string',
            'tech_name' => 'required|string',
            'status' => 'required|string',
            'assigned_at' => 'required|date',
        ]);
    }
}
