<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        Statistic::breadCrumbs('index');

        $users = User::query()
            ->paginate(5);
        return view('far.statistics.user.index', compact('users'));
    }

    public function edit($id)
    {
        Statistic::breadCrumbs('edit');

        $user = User::query()
            ->find($id);
        return view('far.statistics.user.edit', compact('user'));
    }


    public function update($id, Request $request)
    {
        $user = User::query()
            ->find($id);
        $user->role = $request->role;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('statistic.users');
    }


    public function dell($id)
    {
        $user = User::query()
            ->find($id);
        $orders = Order::query()
            ->join('order_items', 'orders.id', '=','order_items.order_id')
            ->where('user_id','=', $id)
            ->get();
        dd($orders);
        $orders->delete();
        $user->delete();
    }
}
