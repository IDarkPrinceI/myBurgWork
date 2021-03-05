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
            ->where('date', '=', Carbon::parse(Carbon::now())->format('d.m.Y'))
            ->firstWhere('email','=', $email);
        if($statistic === null) {
            $statistic = new Statistic();
            $statistic->email = $email;
            $statistic->time = Carbon::now()->format('H:i:s');
            $statistic->date = Carbon::parse(Carbon::now())->format('d.m.Y');
            $statistic->save();
        } else {
            $statistic->email = $email;
            $statistic->time = Carbon::now()->format('H:i:s');
            $statistic->date = Carbon::parse(Carbon::now())->format('d.m.Y');
            $statistic->update();
        }
        return true;
    }

}
