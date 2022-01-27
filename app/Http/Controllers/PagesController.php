<?php

namespace App\Http\Controllers;

use App\Models\Aircon;
use App\Models\AirconOrder;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //

    public function orderRequested()
    {
        if (auth()->user()->isAdmin()) {

            $jobs = Job::where('status', '=', 'booked')->orderBy('created_at', 'desc')->paginate(2);

            return view('pages.admin.order.currentOrder', compact('jobs'));
        }
    }

    public function orderAssigned()
    {
        if (auth()->user()->isAdmin()) {
            $jobs = Job::where('status', '=', 'assigned')->orderBy('created_at', 'desc')->paginate(2);
            $start_date = Job::distinct()->where('status', 'assigned')->pluck('start_date');
            return view('pages.admin.order.assignedOrder', compact(['jobs', 'start_date']));
        }
    }

    public function orderCompleted()
    {
        if (auth()->user()->isAdmin()) {
            $jobs = Job::where('status', '=', 'completed')->orderBy('created_at', 'desc')->paginate(2);

            return view('pages.admin.order.completedOrder', compact('jobs'));
        }
    }

    public function admins()
    {
        $users = User::where('role_id', '=', 2)
            ->paginate(10);

        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }
    public function technicians()
    {
        $users = User::where('role_id', '=', 3)
            ->paginate(10);
        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }
    public function users()
    {
        $users = User::where('role_id', '=', 1)
            ->paginate(10);
        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }

    /* login history page */
    public function loginHistory()
    {

        $users = User::join('authentication_log', 'users.id', '=', 'authentication_log.authenticatable_id')
            ->select('users.*', 'authentication_log.login_at')
            ->whereDate('login_at', '=', now())
            ->orderBy('login_at', 'desc')
            ->paginate(10);

        return view('pages.admin.userManagement.loginHistory', compact('users'));
    }
    public function loginSearch(Request $request)
    {

        $users = User::join('authentication_log', 'users.id', '=', 'authentication_log.authenticatable_id')
            ->where('users.name', 'like', "%$request->name%")
            ->select('users.*', 'authentication_log.login_at')
            ->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('login_at', 'desc')
            ->paginate(10);

        return view('pages.admin.userManagement.loginHistory', compact('users'));
    }

    public function successPage()
    {
        return view('successPage');
    }
}
