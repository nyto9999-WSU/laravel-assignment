<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Order;
use App\Models\User;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('aircons', 'user')
                        ->where('user_id', auth()->id())
                        ->get();

        return view('pages.user.currentOrder', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.addOrder');
    }

    public function store(Request $request)
    {
        $attributes = $this->validateOrder();
        auth()->user()->orders()->create($attributes);

        $order = Order::orderBy('created_at', 'desc')->first(); // fix need to query with user id

        return view('pages.user.addAircon', compact('order'));
    }


    public function show(Order $order)
    {
        abort_if($order->user_id != auth()->id(), 403);

        $order->with('aircons', 'user')
                ->get();

        return view('pages.user.showOrder', compact('order'));

    }


    public function edit($id)
    {
        //
        return back();
    }


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

    protected function validateAirCon()
    {
        return request()->validate([
            'type' => ['required']
        ]);
    }

    protected function validateOrder()
    {
        return request()->validate([
            'desc' => ['required']
        ]);
    }
}
