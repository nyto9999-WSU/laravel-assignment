<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RolePermissionController extends Controller
{

    public function index()
    {
        $users = User::paginate(9);

        return view('auth.rolePermission', compact('users'));
    }

    public function update(Request $request, User $user)
    {

        switch ($request->input('action')) {

            case 'technician':
                $user->update(["role_id" =>  3]);
                break;
            case 'admin':
                $user->update(["role_id" =>  2]);
                break;
            case 'user':
                $user->update(["role_id" =>  1]);
                break;
            case 'delete':
                $user->delete();
                break;
            default:
                break;
        }

        return $this->index();
    }
}
