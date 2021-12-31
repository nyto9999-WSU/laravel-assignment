<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use DB;
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

        if(auth()->user()->isAdmin())
        {
            $orders = Order::with('aircons', 'user')->get();

            return view('pages.admin.order.currentOrder', compact('orders'));
        }


        //role user
        $orders = Order::with('aircons', 'user')
                        ->where('user_id', auth()->id())
                        ->get();
        return view('pages.user.order.currentOrder', compact('orders'));
    }


    public function actions(Order $order)
    {
        switch ($order->status) {

            case 'Booked':
                $technicians = User::technicians()
                                    ->where('tech_available', '=', 1)
                                    ->get();
                return view('pages.admin.job.assignJobToTechnician', compact('order', 'technicians'));

            case 'assigned':
                $tech_id = $order->job->user_id;
                $technician = User::find($tech_id);

                $order->update([
                    "status" =>  'completed',
                    "job_end_date" => now()
                ]);
                $technician->update(["tech_available" => 1]);
                return back();

            case 'completed':
                $order->delete();
                return back();

            default:
                break;
        }
    }

    public function orderRequested()
    {
        if(auth()->user()->isAdmin())
        {
            $orders = Order::with('aircons', 'user')
                            ->where('status', '=', 'Booked')
                            ->get();

            return view('pages.admin.order.currentOrder', compact('orders'));
        }
    }



    public function orderAssigned()
    {
        if(auth()->user()->isAdmin())
        {
            $orders = Order::with('aircons', 'user')
                            ->where('status', '=', 'assigned')
                            ->get();

            return view('pages.admin.order.assignedOrder', compact('orders'));
        }
    }

    public function orderCompleted()
    {
        if(auth()->user()->isAdmin())
        {
            $orders = Order::with('aircons', 'user')
                            ->where('status', '=', 'completed')
                            ->get();

            return view('pages.admin.order.completedOrder', compact('orders'));
        }
    }


    public function create()
    {
        return view('pages.user.order.addOrder');
    }

    public function store(Request $request)
    {

        $attributes = $this->validateOrder();
        auth()->user()->orders()->create($attributes);

        $order = Order::orderBy('created_at', 'desc')->first(); //FIXME: Need more accurate query

        return view('pages.user.order-aircons.addAircon', compact('order'));
    }


    public function show(Order $order)
    {
        abort_unless($order->user_id == auth()->id() || auth()->user()->isAdmin(), 403);


        $tech_id = optional($order->job)->user_id;
        $technician = User::find($tech_id);

        return view('pages.user.order.showOrder', compact('order', 'technician'));

    }


    public function edit(Order $order)
    {
        return view('pages.user.order.editOrder', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $attributes = $this->validateEditOrder();

        $order->update($attributes);

        return $this->edit($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        $order->aircons()->delete();
        return back();
    }


    //validation area
    protected function validateAirCon()
    {
        return request()->validate([
            'equipment_type' => ['nullable']
        ]);
    }

    protected function validateOrder()
    {
        return request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable'],
            'mobile_number' => ['nullable'],
            'no_of_unit' => ['nullable'],
            'install_address' => ['nullable'],
            'state' => ['nullable'],
            'suburb' => ['nullable'],
            'postcode' => ['nullable'],
            'prefer_date' => ['nullable'],
            'prefer_time' => ['nullable'],
            'domestic_commercial' => ['nullable'],
            'extra_note' => ['nullable'],
        ]);
    }

    protected function validateEditOrder()
    {
        return request()->validate([
            'extra_note' => ['nullable'],
        ]);
    }
}
