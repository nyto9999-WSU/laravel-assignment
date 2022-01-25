<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\AirconOrder;
use App\Models\Order;
use App\Models\User;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog as Log;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    // function for search admin jobs
    public function searchRequestedJobs(Request $attr)
    {

        if (auth()->user()->isAdmin()) {

          if($attr->status == 'booked')
          {

            $value = $attr->s;
            $aircons = Aircon::where('model_number', 'like', "%$value%")->pluck('id');
            $order_ids = AirconOrder::wherein('aircon_id', $aircons)->pluck('order_id');
            $orders = Order::with('aircons', 'user');

            $job_order = Job::where('id', $value)->pluck('order_id')->first();

            if(empty($job_order))
            {
              $order_ids->push($job_order);
            }
            $orders =  $orders->where(function ($query2) use ($value, $order_ids) {
                $query2->where('name', 'like', "%$value%")
                    ->orWhereIn('id', $order_ids)
                    ->orWhere('mobile_number', 'like', "%$value%");
            })->orderBy('created_at', 'desc')->get();

            return response()->json([
                'statusCode' => 200,
                'html' => view('pages.admin.search.requested-jobs', get_defined_vars())->render(),
            ]);
          }

          if($attr->status == 'assigned')
          {
            $start_date = $attr->start_date;
            if(!empty($start_date))
            {
              $orders = Order::with('aircons', 'user');
              $order_ids = Job::where('start_date', 'like', "%$start_date%")->pluck('order_id');
              $orders =  $orders->where(function ($query2) use ($order_ids) {
                  $query2->whereIn('id', $order_ids);
              })->orderBy('created_at', 'desc')->get();
            }
            else
            {
              $value = $attr->s;
              $aircons = Aircon::where('model_number', 'like', "%$value%")->pluck('id');
              $order_ids = AirconOrder::wherein('aircon_id', $aircons)->pluck('order_id');
              $orders = Order::with('aircons', 'user');

              $job_order = Job::where('id', 'like', "%$value%")->orWhere('tech_name', 'like', "%$value%")->pluck('order_id');
              // dd($job_order);
              if(!empty($job_order))
              {
                for($x=0;$x<count($job_order); $x++)
                {
                  $order_ids->push($job_order);
                }
              }
              // dd($order_ids);
              $orders =  $orders->where(function ($query2) use ($value, $order_ids) {
                  $query2->where('name', 'like', "%$value%")
                      ->orWhereIn('id', $order_ids)
                      ->orWhere('mobile_number', 'like', "%$value%");
              })->orderBy('created_at', 'desc')->get();
            }


            return response()->json([
                'statusCode' => 200,
                'html' => view('pages.admin.search.assigned-jobs', get_defined_vars())->render(),
            ]);
          }

          if($attr->status == 'completed')
          {
            $value = $attr->s;
            $aircons = Aircon::where('model_number', 'like', "%$value%")->pluck('id');
            $order_ids = AirconOrder::wherein('aircon_id', $aircons)->pluck('order_id');
            $orders = Order::with('aircons', 'user');

            $job_order = Job::where('id', $value)->orWhere('tech_name', 'like', "%$value%")->pluck('order_id');
            if(!empty($job_order))
            {
              for($x=0;$x<count($job_order); $x++)
              {
                $order_ids->push($job_order);
              }
            }
            $orders =  $orders->where(function ($query2) use ($value, $order_ids) {
                $query2->where('name', 'like', "%$value%")
                    ->orWhereIn('id', $order_ids)
                    ->orWhere('mobile_number', 'like', "%$value%");
            })->orderBy('created_at', 'desc')->get();

            return response()->json([
                'statusCode' => 200,
                'html' => view('pages.admin.search.completed-jobs', get_defined_vars())->render(),
            ]);
          }
        }
    }


    // function for search user requested history
    public function searchRequesteHistory(Request $attr)
    {
      $jobs = Job::where('prefer_date', 'like', "%$attr->s%")->pluck('order_id');
      $orders = Order::with('aircons', 'user', 'jobs')
          ->where('user_id', auth()->id())
          ->whereIn('id', $jobs)->get();
        return response()->json([
            'statusCode' => 200,
            'html' => view('pages.user.search.current-orders', get_defined_vars())->render(),
        ]);
    }


    public function orderRequested()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(7);
            return view('pages.admin.order.currentOrder', compact('orders'));
        }
    }

    public function orderAssigned()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(7);
                $start_date = Job::distinct()->where('status', 'assigned')->pluck('start_date');
            return view('pages.admin.order.assignedOrder', compact(['orders', 'start_date']));
        }
    }

    public function orderCompleted()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate(7);

            return view('pages.admin.order.completedOrder', compact('orders'));
        }
    }

    public function admins()
    {
        $users = User::where('role_id', '=', 2)
            ->paginate(9);

        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }
    public function technicians()
    {
        $users = User::where('role_id', '=', 3)
            ->paginate(9);
        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }
    public function users()
    {
        $users = User::where('role_id', '=', 1)
            ->paginate(9);
        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }

    /* login history page */
    public function loginHistory()
    {

        $users = User::join('authentication_log', 'users.id', '=', 'authentication_log.authenticatable_id')
                       ->select('users.*', 'authentication_log.login_at')
                       ->whereDate('login_at', '=', now())
                       ->orderBy('login_at', 'desc')
                       ->paginate(9);

        return view('pages.admin.userManagement.loginHistory', compact('users'));
    }
    public function loginSearch(Request $request)
    {

            $users = User::join('authentication_log', 'users.id', '=', 'authentication_log.authenticatable_id')
            ->where('users.name', 'like', "%$request->name%")
            ->select('users.*', 'authentication_log.login_at')
            ->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('login_at', 'desc')
            ->paginate(9);

        return view('pages.admin.userManagement.loginHistory', compact('users'));
    }
}
