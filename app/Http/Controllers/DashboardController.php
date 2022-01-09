<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\User;
use App\Models\Role;
use App\Models\Job;
use App\Models\Order;
use Carbon\Carbon;
use DB;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $currentYear = now()->format('Y');

        $name = array();

        $job = DB::table('jobs')
            ->join('users', 'jobs.user_id', '=', 'users.id')
            ->select('users.name')
            ->whereBetween('jobs.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->toArray();

        foreach ($job as $j) {
            array_push($name, $j->name);
        }

        $weeklyEffort = array_count_values($name);
        arsort($weeklyEffort);

        $weeklyName = array();
        $weeklyCount = array();
        foreach ($weeklyEffort as $key => $value) {
            $weeklyName[] = $key;
            $weeklyCount[] = $value;
        }

        $roles = Role::withCount('users')->get();

        /* equipment type chart */
        $equipmentChart = $this->getEquipmentQuantity($currentYear);

        /*  monthly order chart */
        $monthlyOrders = $this->getMonthlyOrders($currentYear);

        /*  get user to call login history table's functions */
        $users = User::all()->reverse();

        /*  login history log 2 */
        // $logs = $this->getLoginHistoryLog();

        /* Todasys job */
        $orderAssignQuantity = $this->getOrderAssigneQuantity();
        return view('pages.admin.dashboard', compact('roles', 'monthlyOrders', 'users', 'equipmentChart', 'orderAssignQuantity', 'weeklyName', 'weeklyCount'));
    }





    protected function getEquipmentQuantity($currentYear)
    {
        $type = array('ducted system', 'mini VRF', 'package unit', 'spilt system', 'watercool unit');
        $equipmentChart = array();

        for ($y = $currentYear; $y >= $currentYear - 2; $y--) {
            $equipmentChart[] = $y;

            for ($x = 0; $x < 5; $x++) {
                $typeCount = Aircon::whereYear('created_at', '=', $y)
                    ->where('equipment_type', '=', $type[$x])
                    ->count();
                $equipmentChart[] = $typeCount;
            }

            $otherCount = Aircon::whereYear('created_at', '=', $y)
                ->whereNotNull('other_type')
                ->count();

            $equipmentChart[] = $otherCount;
        }


        return $equipmentChart;
    }

    public function getTechnicianWeeklyEffor()
    { }

    protected function getMonthlyOrders($currentYear)
    {

        $monthlyOrders = array();
        for ($m = 1; $m <= 12; $m++) {
            $count = Order::whereMonth('created_at', '=', $m)
                ->whereYear('created_at', '=', $currentYear)
                ->count();
            $monthlyOrders[] = $count;
        }

        return $monthlyOrders;
    }

    // protected function getLoginHistoryLog()
    // {
    //     $authLog = AuthenticationLog::all();
    //     $logs = array();
    //     for ($x = $authLog->count() - 1; $x >= 1; $x--) {
    //         if ($authLog[$x]->login_at != null) {
    //             $u = User::find($authLog[$x]->authenticatable_id);
    //             $logs[] = 'Name: ' . $u->name . '    Log: ' . $authLog[$x]->login_at->toDateTimeString();
    //         }
    //     }

    //     return $logs;
    // }

    protected function getOrderAssigneQuantity()
    {
        $orderAssignedRate = array();


        $orderAssignedRate[] = Order::whereDate('created_at',  now()->format('y/m/d'))
            ->where('status', '=', 'Booked')
            ->count();

        $orderAssignedRate[] = Order::whereDate('assigned_at', now()->format('y/m/d'))
            ->where('status', '=', 'assigned')
            ->count();

        if ($orderAssignedRate[0] == 0 && $orderAssignedRate[1] == 0) {
            $orderAssignedRate = null;
        }
        return $orderAssignedRate;
    }
}
