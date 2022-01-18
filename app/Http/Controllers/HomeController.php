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
        if(!auth()->user()->isAdmin())
        {
            return view('pages.user.order.addOrder');
        }

        $currentYear = now()->format('Y');

        /* registered user chart */
        $roles = Role::withCount('users')->get();

        /* equipment type chart */
        $equipmentChart = $this->getEquipmentQuantity($currentYear);

        /* technicians weekly effort  */
        $weeklyEffortChart = $this->getTechnicianWeeklyEffort();

        /*  monthly order chart */
        $monthlyOrders = $this->getMonthlyOrders($currentYear);

        /* Todasys job */
        $orderAssignQuantity = $this->getOrderAssigneQuantity();
        return view('home', compact('roles', 'monthlyOrders', 'equipmentChart', 'orderAssignQuantity', 'weeklyEffortChart'));
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

    public function getTechnicianWeeklyEffort()
    {
        $name = array();

        $job = DB::table('jobs')
                ->whereBetween('jobs.assigned_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', '=', 'assigned')
                ->get()
                ->toArray();

        foreach ($job as $j) {
            array_push($name,$j->tech_name);
        }

        $weeklyEffort = array_count_values($name);
        arsort($weeklyEffort);

        $weeklyEffortChart = array();

        foreach($weeklyEffort as $key => $value)
        {
            $weeklyEffortChart[] = $key;
            $weeklyEffortChart[] = $value;
        }

        return $weeklyEffortChart;
    }

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

    protected function getOrderAssigneQuantity()
    {   $orderAssignedRate = array();

        $orderAssignedRate[] = Job::where('status', '=', 'booked')
                                    ->count();

        $orderAssignedRate[] = Job::where('status', '=', 'assigned')
                                    ->count();

        if($orderAssignedRate[0] == 0 && $orderAssignedRate[1] == 0)
        {
            $orderAssignedRate = null;
        }
        return $orderAssignedRate;
    }
}
