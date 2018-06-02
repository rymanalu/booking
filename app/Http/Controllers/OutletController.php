<?php
/**
 * Created by PhpStorm.
 * User: manalu
 * Date: 02/06/18
 * Time: 09.34
 */

namespace App\Http\Controllers;


use App\Http\Requests\OutletRequest;
use App\Outlet;

class OutletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::all();
        return view('outlet.index', compact('outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = new Outlet;
        $isCreate = true;
        return view('outlet.form', compact('outlet', 'isCreate'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutletRequest $request)
    {
        $data = $request->except('_token');

        $outlet = Outlet::create($data);

        if ($outlet) {
            flash()->success('New Outlet successfully created!');
        } else {
            flash()->error('New Outlet failed to create!');
        }

        return redirect()->route('outlet.index');
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
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        $isCreate = false;
        return view('outlet.form', compact('outlet', 'isCreate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(OutletRequest $request, Outlet $outlet)
    {
        $data = $request->except('_token', '_method');
        $result = $outlet->update($data);
        if ($result) {
            flash()->success('Outlet successfully updated!');
        } else {
            flash()->error('Outlet failed to update!');
        }

        return redirect()->route('outlet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $result = $outlet->delete();

        if ($result) {
            flash()->success('Outlet successfully deleted!');
        } else {
            flash()->error('Outlet failed to delete!');
        }

        return redirect()->route('outlet.index');
    }


}