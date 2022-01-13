<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircon;
use App\Models\Order;
use App\Models\User;
use App\Models\Job;

class PagesController extends Controller
{
    //
    // function for search admin jobs
    public function searchRequestedJobs(Request $attr)
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', "$attr->status");
                $value = $attr->s;
              $orders =  $orders->where(function($query2) use ($value)
                 {
                    $query2->where('name', 'like', "%$value%")
                         ->orWhere('mobile_number', 'like', "%$value%")
                         ->orWhere('id', $value);
                 })->get();
                 // dd($orders);
                $status = $attr->status;
            return response()->json([
                'statusCode' => 200,
                'html' => view('pages.admin.search.current-orders', get_defined_vars())->render(),
            ]);
        }
    }

    // function for search user requested history
    public function searchRequesteHistory(Request $attr)
    {
        $orders = Order::with('aircons', 'user')
            ->where('user_id', auth()->id())
            ->where('prefer_date', 'like', "%$attr->s%")
            ->get();
            return response()->json([
                'statusCode' => 200,
                'html' => view('pages.user.search.current-orders', get_defined_vars())->render(),
            ]);
    }


    public function orderRequested()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'Booked')
                ->paginate(7);

            return view('pages.admin.order.currentOrder', compact('orders'));
        }
    }

    public function orderAssigned()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'assigned')
                ->paginate(7);

            return view('pages.admin.order.assignedOrder', compact('orders'));
        }
    }

    public function orderCompleted()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'completed')
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


}
