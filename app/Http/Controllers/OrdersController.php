<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['schedule' => function ($query) {
            $query->with('fromOutlet', 'toOutlet');
        }, 'user'])->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order;
        $schedules = Schedule::with('fromOutlet', 'toOutlet')
            ->where('is_full', false)
            ->where('date', '>=', date('Y-m-d'))
            ->get();
        $users = User::pluck('name', 'id');
        $isCreate = true;

        return view('orders.form', compact('order', 'schedules', 'users', 'isCreate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $result = DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['valid_until'] = Carbon::now()->addHours(2);
            $data['status'] = Order::STATUS_UNPAID;

            $order = Order::create($data);

            $schedule = $order->schedule;
            $decrement = $schedule->decrement('available', $request->qty);
            $schedule->refresh();

            if ($schedule->available == 0) {
                $updated = $schedule->update(['is_full' => true]);
            } else {
                $updated = true;
            }

            return $order && $decrement && $updated;
        });

        if ($result) {
            flash()->success('New order successfully created!');
        } else {
            flash()->error('New order failed to create!');
        }

        return redirect()->route('orders.index');
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $result = DB::transaction(function () use ($order) {
            $schedule = $order->schedule;
            $increment = $schedule->increment('available', $order->qty);
            $updated = $schedule->update(['is_full' => false]);

            $deleted = $order->delete();

            return $increment && $updated && $deleted;
        });

        if ($result) {
            flash()->success('Order successfully deleted!');
        } else {
            flash()->error('Order failed to delete!');
        }

        return redirect()->route('orders.index');
    }

    public function pay(Order $order)
    {
        $updated = $order->update(['status' => Order::STATUS_PAID]);
        $paid = $order->payment()->create([
            'is_confirmed' => true,
            'confirmed_by' => user()->id,
        ]);

        if ($updated && $paid) {
            flash()->success('Order successfully paid!');
        } else {
            flash()->error('Order failed to pay!');
        }

        return redirect()->route('orders.index');
    }
}
