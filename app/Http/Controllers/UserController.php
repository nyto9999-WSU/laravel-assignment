<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('pages.admin.userManagement.currentUsers', compact('users'));
    }


// search function for roles and permissions admin
    public function SearchUser(Request $req)
    {
        $data = $req->all();
        $name = $data['query'];
        $users = User::where('name', 'like', "%$name%")->paginate(3);
        $users->appends(['query' => $name]);
        return view('pages.admin.userManagement.currentUsers', compact(['users', 'name']));
    }


    public function create()
    {
        return view('pages.admin.userManagement.createUser');
    }

    public function store(Request $request)
    {

        $attributes = $this->validateUserCreate();

        User::create($attributes);

        return $this->index();

    }

    public function profile()
    {
        $user = auth()->user();

        return view('pages.admin.userManagement.userProfile', compact('user'));
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
        $attributes = $this->validateUserProfile();

        $user->update($attributes);

        return back();
    }
    public function updateRole(Request $request, User $user)
    {

        switch ($request->input('action')) {

            case 'technician':
                $user->update([
                    "role_id" =>  3,
            ]);

                break;
            case 'admin':
                $user->update([
                    "role_id" =>  2,
                ]);
                break;
            case 'user':
                $user->update([
                    "role_id" =>  1,
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
        return back();
    }



    protected function validateUserProfile()
    {
        return request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable'],
            'mobile_number' => ['nullable'],
            'state' => ['nullable'],
            'postcode' => ['nullable'],
        ]);
    }

    protected function validateUserCreate()
    {
        request()->merge(['password' => Hash::make('aaaa1111')]);
        request()->merge(['remember_token' => Str::random(10)]);

        return request()->validate([
            'name' => ['nullable'],
            'email' => ['nullable'],
            'role_id' => ['nullable'],
            'mobile_number' => ['nullable'],
            'state' => ['nullable'],
            'postcode' => ['nullable'],
            'email_verified_at' => ['nullable'],
            'password' => ['nullable'],
            'remember_token' => ['nullable'],

        ]);


    }

}
