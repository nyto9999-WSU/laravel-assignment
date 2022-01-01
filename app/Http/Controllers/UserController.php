<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(9);

        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        return view('pages.admin.userManagement.showUser', compact('user'));
    }


    public function edit(User $user)
    {
        return view('pages.admin.userManagement.editUser', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        //
        $attributes = $this->validateUser($user);

        $user->update($attributes);

        switch ($user->role_id) {
            case 1:
                return $this->users();
                break;
            case 2:
                return $this->admins();
                break;
            case 3:
                return $this->technicians();
                break;

            default:
                return $this->index();
                break;
        }
    }

    public function updateRole(Request $request, User $user)
    {

        switch ($request->input('action')) {

            case 'technician':
                $user->update([
                    "role_id" =>  3,
                    "tech_available" => 1,
            ]);

                break;
            case 'admin':
                $user->update([
                    "role_id" =>  2,
                    "tech_available" => 0,
                ]);
                break;
            case 'user':
                $user->update([
                    "role_id" =>  1,
                    "tech_available" => 0,
                ]);
                break;
            case 'delete':
                $user->delete();
                break;
            default:
                break;
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        //
        return back();
    }

    protected function validateUser($user)
    {

        // $faker = Faker::create();
        $attributes = request()->validate([
            'name' => ['nullable'],
        ]);

        return $data = [
            'name' => $attributes['name'],
        ];
    }
}
