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
    public function orderRequested()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'Booked')
                ->get();

            return view('pages.admin.order.currentOrder', compact('orders'));
        }
    }

    public function orderAssigned()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'assigned')
                ->get();

            return view('pages.admin.order.assignedOrder', compact('orders'));
        }
    }

    public function orderCompleted()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::with('aircons', 'user')
                ->where('status', '=', 'completed')
                ->get();

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
