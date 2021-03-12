<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    //запрет на поля created_at и update_at
    public $timestamps = false;


//    запись статистики в БД
    public static function writeStatistic($email)
    {
        $statistic = Statistic::query()
            ->where('date', '=', self::parseNow())
            ->firstWhere('email', '=', $email);
        if ($statistic === null) {
            $statistic = new Statistic();
            self::writeAttributes($statistic, $email);
            $statistic->save();
        } else {
            self::writeAttributes($statistic, $email);
            $statistic->update();
        }
        return true;
    }

//    подсчет пользователей за дату
    public static function countUsers($res, $date)
    {
        $users = Statistic::query()
            ->join('users', 'users.email', '=','statistics.email')
            ->select('statistics.*', 'users.role')
            ->where('date', '=', $date)
            ->where('users.role', '=', 'user')
            ->count();
        array_push($res, $users);
        return $res;
    }

//    Форматировани времени в нужный формат
    public static function parseNow()
    {
        $nowDate = Carbon::parse(Carbon::now())->format('d.m.Y');
        return $nowDate;
    }

//    заполнение атрибутов
    public static function writeAttributes($statistic, $email)
    {
        $statistic->email = $email;
        $statistic->time = Carbon::now()->format('H:i:s');
        $statistic->date = self::parseNow();
    }

}
