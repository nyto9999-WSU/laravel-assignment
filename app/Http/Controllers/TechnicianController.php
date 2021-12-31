<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Faker\Factory as Faker;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technicians = User::technicians()->paginate(9);

        return view('pages.admin.technician.currentTechnicians', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attributes = $this->validateTechnician();
        $technician = User::create($attributes);
        $technician->update(["tech_available" => 1]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $technician)
    {
        return view('pages.admin.technician.editTechnician', compact('technician'));
    }


    public function update(Request $request, User $technician)
    {
        //
        $attributes = $this->validateEditTechnician();

        $technician->update($attributes);

        return $this->edit($technician);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $technician)
    {
        $technician->delete();
        return back();
    }

    protected function validateTechnician()
    {
        $faker = Faker::create();
        $attributes = request()->validate([
            'name' => ['nullable'],
        ]);

        return $data = [
            'name' => $attributes['name'],
            'role_id' => 3,
            'email' => $faker->unique()->safeEmail(),
        ];
    }

    protected function validateEditTechnician()
    {
        return request()->validate([
            'name' => ['nullable'],
        ]);
    }

}
