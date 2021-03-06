<?php

namespace App\Http\Controllers;

use App\Models\Aircon;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->isAdmin()) {
            $jobs = Job::paginate(10);

            return view('pages.admin.order.currentOrder', compact('jobs'));
        }

        //role user
        $jobs = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
                    ->select('jobs.*', 'orders.user_id')
                    ->where('user_id', '=', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('pages.user.order.currentOrder', compact('jobs'));
    }

    public function actions(Order $order, Job $job)
    {

        switch ($job->status) {

            case 'booked':
                $technicians = User::technicians()->get();
                $aircon = Aircon::find($job->aircon_id);

                /* calendar */
                $requestedJob = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
                    ->select('jobs.*', 'orders.mobile_number')
                    ->where('status', '=', 'booked')->get();
                $assignedJob = Job::join('orders', 'jobs.order_id', '=', 'orders.id')
                    ->select('jobs.*', 'orders.mobile_number')
                    ->where('status', '=', 'assigned')->get();
                if (!count($requestedJob)) {
                    $requested_id = null;
                    $r_model = null;
                    $r_serial = null;
                    $r_mobile = null;
                    $r_install_address = null;
                    $r_dc = null;
                    $prefer_start = null;
                    $prefer_end = null;
                }
                if (!count($assignedJob)) {
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
                foreach ($requestedJob as $j) {

                    // $created = $order->created_at->format('d-M');
                    $p_date = $j->prefer_date;
                    switch ($j->prefer_time) {
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
                    $requested_id[] = $j->id;
                    $r_model[] = $j->model_number;
                    $r_serial[] = $j->serial_number;
                    $r_mobile[] = $j->mobile_number;
                    $r_install_address[] = $j->install_address;
                    $r_dc[] = $j->domestic_commercial;
                    $prefer_start[] = "${p_date}T${s}";
                    $prefer_end[] = "${p_date}T${e}";
                    // $created_at[] = "${created}";
                }

                /* Assigned j */
                foreach ($assignedJob as $j) {
                    $j_date = $j->start_date;
                    switch ($j->start_time) {
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
                    $assigned_id[] = $j->id;
                    $a_model[] = $j->model_number;
                    $a_serial[] = $j->serial_number;
                    $a_mobile[] = $j->mobile_number;
                    $a_install_address[] = $j->install_address;
                    $tech_name[] = $j->tech_name;
                    $a_dc[] = $j->domestic_commercial;
                    $job_start[] = "${j_date}T${js}";
                    $job_end[] = "${j_date}T${je}";
                }

                return view('pages.admin.job.assignJobToTechnician', compact('order', 'job', 'technicians', 'aircon',
                    'requested_id', 'r_model', 'r_serial', 'prefer_start', 'prefer_end', 'r_install_address', 'r_mobile', 'r_dc',
                    'assigned_id', 'a_model', 'a_serial', 'job_start', 'job_end', 'a_install_address', 'tech_name', 'a_mobile', 'a_dc'));

            case 'assigned':

                $job->update([
                    "status" => 'completed',
                    "end_date" => now(),
                ]);

                return back();

            default:
                break;
        }
    }

    public function create()
    {
        $orderRecord = auth()->user()->orders()->latest()->first();

        return view('pages.user.order.addOrder', compact('orderRecord'));
    }

    public function store(Request $request)
    {

        $attributes = $this->validateOrder();

        auth()->user()->orders()->create($attributes);
        $order = Order::where('user_id', '=', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('pages.user.order-aircons.addAircon', compact('order'));
    }

    public function show($id, Job $job)
    {
        abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);

        return view('pages.user.order.showOrder', compact('order', 'technician'));
    }

    public function printOrder(Order $order, Job $job)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        return view('pages.admin.order.print-order', compact('order', 'job'));
    }

    public function printAllOrder(Request $request)
    {
      if(empty($request->start_date))
      {
        $jobs = Job::with('order')->where('status', 'assigned')->get();
      }
      else
      {
        $jobs = Job::with('order')->where('start_date', $request->start_date)->where('status', 'assigned')->get();
      }
        return view('pages.admin.order.print-all-order', compact('jobs'));
    }

    public function edit(Order $order, Job $job)
    {
        $technicians = User::technicians()->get();
        return view('pages.user.order.editOrder', compact('order', 'job', 'technicians'));
    }

    public function update(Request $request, Order $order, Job $job)
    {
        $attributes = $this->validateUpdateJob();
        $attributes2 = $this->validateUpdateAircon();
        $aircon = Aircon::find($job->aircon_id);

        $job->update($attributes);
        $aircon->update($attributes2);

        return back()->with('message', 'Updated successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

    }

    protected function validateOrder()
    {
        return request()->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'mobile_number' => 'required|numeric',
            'address' => 'required|string',
            'state' => 'required|string',
            'suburb' => 'required|string',
            'postcode' => 'required|string',
            'extra_note' => 'nullable|string',
        ],
        );
    }

    protected function validateUpdateJob()
    {

        if (isset(request()->prefer_date)) {
            $prefer_date = Carbon::createFromFormat('d-m-Y', request()->prefer_date)->format('Y-m-d');
            request()->merge(['prefer_date' => $prefer_date]);
        }

        if (isset(request()->start_date)) {
            $start_date = Carbon::createFromFormat('d-m-Y', request()->start_date)->format('Y-m-d');
            request()->merge(['start_date' => $start_date]);
        }
        if (isset(request()->booked)) {
            request()->merge(['status' => 'booked']);
            request()->merge(['start_date' => null]);
            request()->merge(['start_time' => null]);
            request()->merge(['tech_name' => null]);
        }
        if (isset(request()->assigned)) {
            request()->merge(['status' => 'assigned']);
            request()->merge(['end_date' => null]);
        }

        return request()->validate([
            'model_number' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'install_address' => 'nullable|string',
            'equipment_type' => 'nullable|string',
            'domestic_commercial' => 'nullable|string',
            'prefer_date' => 'nullable',
            'prefer_time' => 'nullable|string',
            'issue' => 'nullable|string',
            'start_date' => 'nullable',
            'start_time' => 'nullable|string',
            'end_date' => 'nullable',
            'tech_name' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
    }

    protected function validateUpdateAircon()
    {
        return request()->validate([
            'model_number' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'install_address' => 'nullable|string',
            'equipment_type' => 'nullable|string',
            'domestic_commercial' => 'nullable|string',
            'issue' => 'nullable|string',
        ]);
    }
}
