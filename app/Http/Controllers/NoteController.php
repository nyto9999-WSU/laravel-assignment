<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Job;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request, Order $order)
    // {

    //     $attributes = $this->validateAirCon();

    //     $order->notes()->create($attributes);

    //     return (new OrderController)->actions($order);
    // }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $note = Note::find($id);
        $note->delete();
        return back();
    }

    protected function validateAirCon()
    {

        return request()->validate([
            'description' => ['nullable'],
        ]);
    }

    public function noteAjax(Request $request)
    {
        if($request->ajax())
        {
            $attributes = $this->validateAirCon();

            $job = Job::find($request->id);
            $job->notes()->create($attributes);
            $notes = $job->notes;
            // return response()->json(['success'=>'Data successfull loaded','data'=>$request->data, 'id'=>$request->id]);
            // return response()->json($notes);
            return $notes;
        }

    }
}
