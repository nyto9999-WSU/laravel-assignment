<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use DB;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

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
            $orders = Order::with('aircons', 'user')->paginate(10);

            return view('pages.admin.order.currentOrder', compact('orders'));
        }

        //role user
        $orders = Order::with('aircons', 'user')
            ->where('user_id', auth()->id())
            ->paginate(10);
        return view('pages.user.order.currentOrder', compact('orders'));
    }


    public function actions(Order $order, Job $job)
    {
        switch ($job->status) {

            case 'booked':
                $technicians = User::technicians()->get();
                $aircon = Aircon::find($job->aircon_id);

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
                foreach ($requestedJob as $job) {

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
                foreach ($assignedJob as $job) {
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
                return view('pages.admin.job.assignJobToTechnician', compact('order', 'job', 'technicians', 'aircon',
                'requested_id','r_model', 'r_serial','prefer_start','prefer_end','r_install_address', 'r_mobile', 'r_dc',
                'assigned_id','a_model','a_serial','job_start', 'job_end', 'a_install_address', 'tech_name','a_mobile', 'a_dc'));

            case 'assigned':

                $job->update([
                    "status" =>  'completed',
                    "end_date" => now()
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
        // abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);

        // $technician = $order->getTechnician();

        return view('pages.user.order.showOrder', compact('order', 'technician'));
    }


    public function printOrder($order)
    {
        // abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);
        $order = Order::find($order);
        $technician = $order->getTechnician();

        return view('pages.admin.order.print-order', compact('order', 'technician'));
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

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // if($order->relation)
        // {

        //     $order->job()->delete();
        // }

        // $order->aircons->each->delete();

        // $order->delete();


        // return back();
    }

    protected function validateOrder()
    {
        return request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable'],
            'mobile_number' => ['nullable'],
            'address' => ['nullable'],
            'state' => ['nullable'],
            'suburb' => ['nullable'],
            'postcode' => ['nullable'],
            'extra_note' => ['nullable'],
        ]);
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
            'model_number' => ['nullable'],
            'serial_number' => ['nullable'],
            'install_address' => ['nullable'],
            'equipment_type' => ['nullable'],
            'domestic_commercial' => ['nullable'],
            'prefer_date' => ['nullable'],
            'prefer_time' => ['nullable'],
            'issue' => ['nullable'],
            'start_date' => ['nullable'],
            'start_time' => ['nullable'],
            'end_date' => ['nullable'],
            'tech_name' => ['nullable'],
            'status' => ['nullable'],
        ]);
    }


    protected function validateUpdateAircon()
    {
        return request()->validate([
            'model_number' => ['nullable'],
            'serial_number' => ['nullable'],
            'install_address' => ['nullable'],
            'equipment_type' => ['nullable'],
            'domestic_commercial' => ['nullable'],
            'issue' => ['nullable'],
        ]);
    }
}
