<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Models\Aircon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use URL;
use Illuminate\Support\Facades\Redirect;

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
        //
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
        //
        $attributes = $this->validateAirCon();

        $order = Order::find($order->id);
        $order->aircons()->create($attributes);

        return view('pages.user.addAircon',compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aircon $aircon, Order $order)
    {

        abort_unless($order->user_id == auth()->id() || auth()->user()->role == "admin", 403);

        return view('pages.admin.showAircon', compact('aircon'));


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
    public function destroy(Aircon $aircon)
    {
        // $aircon->delete();
    }

    protected function validateAirCon()
    {
        return request()->validate([
            'type' => ['required']
        ]);
    }

}
