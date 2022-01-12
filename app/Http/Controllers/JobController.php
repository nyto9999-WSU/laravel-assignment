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
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request, Order $order)
    {
        $jobAttributes = $this->validateJob($order);
        $orderAttributes = $this->validateOrder();

        $order->job()->create($jobAttributes);
        $order->update($orderAttributes);

        $technician = $order->getTechnician();
        $technician->update(["tech_available" => 0]);

        return (new PagesController)->orderRequested();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    {
        //
    }

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

    protected function validateJob($order)
    {

        $attributes = request()->validate([
            'tech_name' => ['nullable'],
        ]);

        return $data = [
            'order_id' => $order->id,
            'tech_name' => $attributes['tech_name'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }

    protected function validateOrder()
    {

        $validation = request()->validate([
            'job_start_date' => ['nullable'],
            'job_start_time' => ['nullable'],
        ]);

        $mySQL_date = Carbon::createFromFormat('d-m-Y', $validation['job_start_date'])->format('Y-m-d');
        return $data = [
            "status" =>  'assigned',
            'job_start_date' => $mySQL_date,
            'job_start_time' => $validation["job_start_time"],
            'assigned_at' => now(),
        ];

    }
}
