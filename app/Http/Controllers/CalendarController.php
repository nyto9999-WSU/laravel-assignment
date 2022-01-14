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
        $requestedJob = Job::where('status', '=', 'booked')->get();
        $assignedJob = Job::where('status', '=', 'assigned')->get();

        if(!count($requestedJob)){
            $requested_id = null;
            $prefer_start = null;
            $prefer_end = null;
        }
        if(!count($assignedJob)){
            $assigned_id = null;
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
                // $install_address[] = $order->install_address;
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
            // $install_address[] = $order->install_address;
            $job_start[] = "${j_date}T${js}";
            $job_end[] = "${j_date}T${je}";
        }



        return view('pages.admin.calendar', compact('requested_id','prefer_start','prefer_end','assigned_id', 'job_start', 'job_end'));
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
