<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Job;
use App\Models\Order;
use Session;
use Illuminate\Support\Carbon;
use function Symfony\Component\String\b;

class AirConController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.order-aircons.addAircon');
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $order = Order::find($order->id);

        $airconAtrr = $this->validateAirCon();
        $jobAttr = $this->validateJob();

        /* create aircon */
        $order->aircons()->create($airconAtrr);

        /* create job */
        $latestAircon = $order->aircons()->latest()->first();

        $job = $order->jobs()->create($jobAttr);
        $job->update([
            "aircon_id" => $latestAircon->id
        ]);

        /* FIXME: */
        return view('pages.user.order-aircons.addAircon', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Order $order)
    {

        abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);

        $job = Job::find($id);
        return view('pages.user.order-aircons.showAirconDetails', compact('job'));
    }

    /* TODO:Show all aircons details */
    public function showAll(Order $order)
    {
        $jobs = $order->jobs;

        abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);

        return view('pages.user.order-aircons.showAllAirconDetails', compact('jobs'));
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
    public function update(Request $request, Order $order)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Aircon $aircon, Order $order)
    {
        $aircon->delete();
        return view('pages.user.order-aircons.addAircon', compact('order'));
    }

    protected function validateAirCon()
    {
        if (isset(request()->other_type)) {
            request()->merge(['equipment_type' => request()->other_type]);
        }

        return request()->validate([
            'model_number' => ['required'],
            'serial_number' => ['nullable'],
            'equipment_type' => ['nullable'],
            'other_type' => ['nullable'],
            'domestic_commercial' => ['nullable'],
            'install_address' => ['nullable'],
            'issue' => ['nullable'],
        ]);

    }

    protected function validateJob()
    {

        if (isset(request()->other_type)) {
            request()->merge(['equipment_type' => request()->other_type]);
        }
        if(isset(request()->prefer_date)) {
            $prefer_date = Carbon::createFromFormat('d-m-Y', request()->prefer_date)->format('Y-m-d');
            request()->merge(['prefer_date' => $prefer_date]);
        }
        return request()->validate([
            'prefer_date' => ['nullable'],
            'prefer_time' => ['nullable'],
            'domestic_commercial' => ['nullable'],
            'model_number' => ['nullable'],
            'serial_number' => ['nullable'],
            'equipment_type' => ['nullable'],
            'other_type' => ['nullable'],
            'install_address' => ['nullable'],
            'issue' => ['nullable'],
        ]);
    }
}
