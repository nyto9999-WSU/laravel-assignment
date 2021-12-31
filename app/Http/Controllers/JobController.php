<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;
use DB;
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

        $attributes = $this->validateAssignment($order);
        $attributes2 = $this->validateOrder();

        $order->job()->create($attributes);

        $tech_id = $order->job->user_id;
        $technician = User::find($tech_id);


        $order->update($attributes2);

        $technician->update(["tech_available" => 0]);

        return (new OrderController)->orderRequested();
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

    protected function validateAssignment($order)
    {

        $attributes = request()->validate([
            'tech_id' => ['nullable'],
        ]);

        return $data = [
            'order_id' => $order->id,
            'user_id' => $attributes['tech_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }

    protected function validateOrder()
    {

        $attributes = request()->validate([
            'job_start_date' => ['nullable'],
        ]);

        return $data = [
            "status" =>  'assigned',
            'job_start_date' => $attributes["job_start_date"],
            'assigned_at' => now(),
        ];

    }
}
