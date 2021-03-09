<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;

    public static function writeStatistic($email)
    {
        $statistic = Statistic::query()
            ->where('date', '=', self::parseNow())
            ->firstWhere('email','=', $email);
        if($statistic === null) {
            $statistic = new Statistic();
            self::writeAttributes($statistic, $email);
            $statistic->save();
        } else {
            self::writeAttributes($statistic, $email);
            $statistic->update();
        }
        return true;
    }


    public static function countUsers($res, $date)
    {
        $users = Statistic::query()
            ->where('date' ,'=', $date)
            ->count();
        array_push($res, $users);
        return $res;
    }


    public static function parseNow()
    {
        $nowDate = Carbon::parse(Carbon::now())->format('d.m.Y');
        return $nowDate;
    }


    public static function writeAttributes($statistic, $email)
    {
        $statistic->email = $email;
        $statistic->time = Carbon::now()->format('H:i:s');
        $statistic->date = self::parseNow();
    }

}
