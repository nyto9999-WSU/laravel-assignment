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


    public function actions(Order $order, Job $job)
    {
        switch ($job->status) {

            case 'booked':
                $technicians = User::technicians()->get();
                $aircon = Aircon::find($job->aircon_id);
                return view('pages.admin.job.assignJobToTechnician', compact('order','job', 'technicians', 'aircon'));

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


    public function update(Request $request, Order $order)
    {
        $attributes = $this->validateEditOrder();

        $order->update($attributes);

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
        if($order->relation)
        {

            $order->job()->delete();
        }

        $order->aircons->each->delete();

        $order->delete();


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
            'address' => ['nullable'],
            'state' => ['nullable'],
            'suburb' => ['nullable'],
            'postcode' => ['nullable'],
            'extra_note' => ['nullable'],
        ]);

        // $mySQL_date = Carbon::createFromFormat('d-m-Y', $validation['prefer_date'])->format('Y-m-d');

        // return $data = [
        //     'prefer_date' => $mySQL_date,
        // ];

    }

    protected function validateEditOrder()
    {
        return request()->validate([
            'extra_note' => ['nullable'],

        ]);
    }
}
