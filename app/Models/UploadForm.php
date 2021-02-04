<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Date;
use function GuzzleHttp\Psr7\str;

class UploadForm extends Model
{
    private static $dir = 'assets/far/img/';


    public static function randomName($extension)
    {
        $name = md5(microtime() . rand(0, 1000));
        $file = $name . '.' . $extension;
        return $file;
    }

    public static function reSize($path, $extension)
    {
        $imgProperty = getimagesize($path);
        $imgWight = $imgProperty[0];
        $imgHeight = $imgProperty[1];
        $standardWight = 500;
        //пропорции
        $ratio = $imgWight / $standardWight;
        $wightNewImg = round($imgWight / $ratio);
        $heightNewImg = round($imgHeight / $ratio);

        //cоздаем новое изображение заданных параметров
        $newImg = imagecreatetruecolor($wightNewImg, $heightNewImg);
        if ($extension === 'png') {
            $uploadImg = imagecreatefrompng($path);
        } else {
            $uploadImg = imagecreatefromjpeg($path);
        }
        imagecopyresampled($newImg, $uploadImg, 0, 0, 0, 0, $wightNewImg, $heightNewImg, $imgWight, $imgHeight);

        if ($extension === 'png') {
            imagepng($newImg, $path);
        } else {
            imagejpeg($newImg, $path);
        }

        //уничтожаем данные
        imagedestroy($newImg);
        imagedestroy($uploadImg);
    }

    public static function getPath($type)
    {
        return static::$dir . $type . '/';
    }

    public static function dropImg($type, $file)
    {
        unlink(self::getPath($type) . $file);
    }

    public static function moveImg($type, $file)
    {
        $dateNowPath = self::getPath($type) . 'old/' . date('Y-m-d');
        if (!file_exists($dateNowPath)) {
            mkdir($dateNowPath, 0777, true);
        }
        $newPath = $dateNowPath . '/' . $file;
        $oldPath = self::getPath($type) . $file;
        \Illuminate\Support\Facades\File::move($oldPath, $newPath);
    }

    public static function upload($type, $request, $img = null) {
//        dd($request);
        $dir = self::getPath($type);

        if ($request->has('oldImg')) {
            self::dropImg($type, $img);
            $img = null;
        }
        if ($request->has('onMove')) {
            self::moveImg($type, $img);
            $img = null;
        }
        if ($request->img) {
            $extension = $request->img->extension();
            $file = self::randomName($extension);
            $path = $dir . $file;
            $request->img->move(public_path($dir), $file);
            self::reSize($path, $extension);
        } elseif ($img) {
            $file = $img;
        } else {
            $file = 'no-image.png';
        }
        return $file;
    }
}
