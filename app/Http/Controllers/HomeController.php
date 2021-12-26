<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $roles = Role::withCount('users')->get();


        $months = array();
        $year = Carbon::now()->format('Y');
        for ($x = 1; $x <= 12; $x++) {
            $count = Order::whereMonth('created_at', '=', $x)
            ->whereYear('created_at', '=', $year)
            ->count();
            $months[] = $count;
        }


        // $date = date('M', $orders->all()[0]->created_at->timestamp);

        return view('home', compact('roles', 'months'));
    }
}
