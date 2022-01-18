<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Job;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Foreach_;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $requestedJob = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
                            ->select('jobs.*', 'orders.mobile_number')
                            ->where('status', '=', 'booked')->get();
        $assignedJob = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
                            ->select('jobs.*', 'orders.mobile_number')
                            ->where('status', '=', 'assigned')->get();
        if(!count($requestedJob)){
            $requested_id = null;
            $r_model = null;
            $r_serial = null;
            $r_mobile = null;
            $r_install_address = null;
            $r_dc = null;
            $prefer_start = null;
            $prefer_end = null;
        }
        if(!count($assignedJob)){
            $assigned_id = null;
            $a_model = null;
            $a_serial = null;
            $a_mobile = null;
            $a_install_address = null;
            $tech_name = null;
            $a_dc = null;
            $job_start = null;
            $job_end = null;

        }

        /* Requested Job */
        foreach($requestedJob as $job)
        {

            // $created = $order->created_at->format('d-M');
            $p_date = $job->prefer_date;
            switch ($job->prefer_time) {
                case 'Morning':
                    $s = "09:00:00";
                    $e = "12:00:00";
                    break;
                case 'Afternoon':
                    $s = "12:00:00";
                    $e = "15:00:00";
                    break;
                case 'Morning':
                    $s = "15:00:00";
                    $e = "18:00:00";
                    break;

                    default:
                    $s = "15:00:00";
                    $e = "18:00:00";
                    break;
                }
                $requested_id[] = $job->id;
                $r_model[] = $job->model_number;
                $r_serial[] = $job->serial_number;
                $r_mobile[] = $job->mobile_number;
                $r_install_address[] = $job->install_address;
                $r_dc[] = $job->domestic_commercial;
                $prefer_start[] = "${p_date}T${s}";
                $prefer_end[] = "${p_date}T${e}";
                // $created_at[] = "${created}";
        }

        /* Assigned Job */
        foreach($assignedJob as $job)
        {
            $j_date = $job->start_date;
            switch ($job->start_time) {
                case 'Morning':
                    $js = "09:00:00";
                    $je = "12:00:00";
                    break;
                case 'Afternoon':
                    $js = "12:00:00";
                    $je = "15:00:00";
                    break;
                case 'Evening':
                    $js = "15:00:00";
                    $je = "18:00:00";
                    break;

                default:
                    $js = "15:00:00";
                    $je = "18:00:00";
                    break;
            }
            $assigned_id[] = $job->id;
            $a_model[] = $job->model_number;
            $a_serial[] = $job->serial_number;
            $a_mobile[] = $job->mobile_number;
            $a_install_address[] = $job->install_address;
            $tech_name[] = $job->tech_name;
            $a_dc[] = $job->domestic_commercial;
            $job_start[] = "${j_date}T${js}";
            $job_end[] = "${j_date}T${je}";
        }

        return view('pages.admin.calendar',
        compact('requested_id','r_model', 'r_serial','prefer_start','prefer_end','r_install_address', 'r_mobile', 'r_dc',
        'assigned_id','a_model','a_serial','job_start', 'job_end', 'a_install_address', 'tech_name','a_mobile', 'a_dc'));
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
    public function store(Request $request)
    {
        //
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
}
