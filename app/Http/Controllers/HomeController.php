<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use Carbon\Carbon;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
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

    public function index(Request $request)
    {
        $currentYear = Carbon::now()->format('Y');

        /* equipment type */
        $type = array('ducted system', 'mini VRF', 'package unit', 'spilt system', 'watercool unit');
        $typeChart = array();

        for($y = $currentYear ; $y >= $currentYear-2 ; $y--)
        {
            $typeChart[] = $y;

            for ($x = 0; $x < 5; $x++)
            {
                $typeCount = Aircon::whereYear('created_at', '=', $y)
                                ->where('equipment_type', '=', $type[$x])
                                ->count();
                $typeChart[] = $typeCount;

            }

            $otherCount = Aircon::whereYear('created_at', '=', $y)
                            ->whereNotNull('other_type')
                            ->count();

            $typeChart[] = $otherCount;
        }

        /* Order quantity yearly */
        $roles = Role::withCount('users')->get();
        $monthlyOrders = array();
        for ($x = 1; $x <= 12; $x++) {
            $count = Order::whereMonth('created_at', '=', $x)
            ->whereYear('created_at', '=', $currentYear)
            ->count();
            $monthlyOrders[] = $count;
        }

        /* Registered User Number */
        $users = User::all();
        $users = $users->reverse();


        /* login history */
        $authLog = AuthenticationLog::all();
        $logs = array();
        for($x = $authLog->count()-1; $x >= 1; $x--)
        {
            if($authLog[$x]->login_at != null)
            {
                $u = User::find($authLog[$x]->authenticatable_id);
                $logs[] = 'Name: ' .$u->name. '    Log: ' .$authLog[$x]->login_at->toDateTimeString();
            }
        }

        return view('home', compact('roles', 'monthlyOrders', 'users', 'logs', 'typeChart'));
    }
}
