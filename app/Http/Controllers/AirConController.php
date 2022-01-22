<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use PDF;
use Illuminate\Support\Facades\Storage;

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


        return view('pages.user.order-aircons.addAircon', compact('order'));
    }

    public function sendMail(Request $request, Order $order)
    {
        $pdf = PDF::loadView('pdf.orderPDF', ["order" => $order]);
        $filename = "order_" . time() . ".pdf";
        Storage::disk('public_pdf')->put($filename, $pdf->output());

        Mail::to('nyto9999@gmail.com')->send(new OrderMail($order, $filename));

        return (new OrderController)->index();
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

        $job_aircon = Aircon::find($aircon->id);
        $job = Job::where('id', '=', $job_aircon->id);
        $aircon->delete();
        $job->delete();
        return view('pages.user.order-aircons.addAircon', compact('order'));
    }

    protected function validateAirCon()
    {
        if (isset(request()->other_type)) {
            request()->merge(['equipment_type' => request()->other_type]);
        }

        return request()->validate([
            'model_number' => 'required',
            'serial_number' => 'required',
            'equipment_type' => 'nullable',
            'other_type' => 'nullable',
            'domestic_commercial' => 'required|string',
            'install_address' => 'required|string',
            'issue' => 'nullable',
        ]);
    }

    protected function validateJob()
    {

        if (isset(request()->other_type)) {
            request()->merge(['equipment_type' => request()->other_type]);
        }
        if (isset(request()->prefer_date)) {
            $prefer_date = Carbon::createFromFormat('d-m-Y', request()->prefer_date)->format('Y-m-d');
            request()->merge(['prefer_date' => $prefer_date]);
        }
        return request()->validate([
            'prefer_date' => 'required',
            'prefer_time' => 'required',
            'domestic_commercial' => 'required|string',
            'model_number' => 'required|string',
            'serial_number' => 'required|string',
            'equipment_type' => 'nullable',
            'other_type' => 'nullable',
            'install_address' => 'required|string',
            'issue' => 'nullable|string',
        ]);
    }
}
