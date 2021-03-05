<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\BreadCrumbs;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        BreadCrumbs::breadCrumbs('index', 'Список пользователей', 'statistic.users');

        $users = User::query()
            ->paginate(5);
        return view('far.statistics.user.index', compact('users'));
    }

    public function edit($id)
    {
        BreadCrumbs::breadCrumbs('edit', 'Редактирование');
        $user = User::getUser($id);

        return view('far.statistics.user.edit', compact('user'));
    }


    public function update($id, Request $request)
    {
        $user = User::getUser($id);
        $user = User::writeAttributes($user, $request);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('statistic.users');
    }


    public function dell($id)
    {
        $user = User::getUser($id);

        $orders = Order::query()
            ->where('user_id','=', $id)
            ->get();
        foreach ($orders as $order_id) {
            $orderItem = OrderItem::query()
                ->firstWhere('order_id', '=', $order_id->id);
            $orderItem->delete();
            $order_id->delete();
        }
        $user->delete();
        session()->flash('success-dell', "Пользователь '$user->name' удален!");
    }


    public function datePick()
    {
        return view('far.statistics.user.datePick');
    }


    public function chart($dateStart, $dateFinish)
    {
        $date = Carbon::parse($dateStart, 'd.m.Y');
        $newdate = $date->addDay();

        $usersStart = Statistic::query()
            ->where('date' ,'=', $dateStart)
            ->count();
        $usersFinish = Statistic::query()
            ->where('date' ,'=', $dateFinish)
            ->count();
//        $userThree = Statistic::query()
//            ->where('date' ,'=', $newdate)
//            ->count();
        return [$usersStart, $usersFinish];
    }
}
