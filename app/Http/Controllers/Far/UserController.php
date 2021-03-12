<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Far\MainController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends MainController
{
    //страница список пользователей
    public function index()
    {
        $this->breadCrumbs('index', 'Список пользователей', 'statistic.users');

        $users = User::query()
            ->paginate(5);
        return view('far.statistics.user.index', compact('users'));
    }

    //страница обновление пользователя
    public function edit($id)
    {
        $this->breadCrumbs('edit', 'Редактирование');
        $user = User::getUser($id);

        return view('far.statistics.user.edit', compact('user'));
    }

    //обновление пользователя
    public function update($id, Request $request)
    {
        $user = User::getUser($id);
        $user = User::writeAttributes($user, $request);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('statistic.users');
    }

    //удаление пользователя
    public function dell($id)
    {
        $user = User::getUser($id);

        $orders = Order::query()
            ->where('user_id', '=', $id)
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

    //страница уникальных пользователей
    public function datePick()
    {
        $this->breadCrumbs('index', 'Построение графика');
        return view('far.statistics.user.datePick');
    }

    //получение данных для графика уникальных пользователей
    public function chart($dateStart, $dateFinish)
    {
        $res = [];
        $labels = [];
        $dateStart = Carbon::parse($dateStart)->addDays(-1);
        $dateFinish = Carbon::parse($dateFinish);
        $dif = $dateFinish->diff($dateStart)->days;

        for ($day = 1; $day <= $dif; $day++) {
            $dateStart = $dateStart->addDays();
            $formatDate = Carbon::parse($dateStart)->format('d.m.Y');
            $res = Statistic::countUsers($res, $formatDate);
            array_push($labels, $formatDate);
        }
        return [$labels, $res];
    }


}
