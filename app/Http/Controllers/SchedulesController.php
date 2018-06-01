<?php

namespace App\Http\Controllers;

use App\Outlet;
use App\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;

class SchedulesController extends Controller
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
        $schedules = Schedule::with('fromOutlet', 'toOutlet')->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule = new Schedule;

        $isCreate = true;

        $outlets = Outlet::pluck('name', 'id');

        return view('schedules.form', compact('schedule', 'isCreate', 'outlets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $data = $request->except('_token');

        $schedule = Schedule::create($data);

        if ($schedule) {
            flash()->success('New schedule successfully created!');
        } else {
            flash()->error('New schedule failed to create!');
        }

        return redirect()->route('schedules.index');
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
    public function edit(Schedule $schedule)
    {
        $isCreate = false;

        $outlets = Outlet::pluck('name', 'id');

        return view('schedules.form', compact('schedule', 'isCreate', 'outlets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $data = $request->except('_token', '_method');

        $result = $schedule->update($data);

        if ($result) {
            flash()->success('Schedule successfully updated!');
        } else {
            flash()->error('Schedule failed to update!');
        }

        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $result = $schedule->delete();

        if ($result) {
            flash()->success('Schedule successfully deleted!');
        } else {
            flash()->error('Schedule failed to delete!');
        }

        return redirect()->route('schedules.index');
    }
}
