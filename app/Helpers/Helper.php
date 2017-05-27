<?php

namespace App\Helpers;

use App\Http\Controllers\Slim;
use Auth;

class Helper
{
    /**
     * @param  [input] from HTML input name <input name="avatar" type="file">
     * @param  [destination] where to upload current image
     * @return [name] name of uploaded image to store in database
     */
    public static function uploadImage($input, $destination)
	{
		$avatar  = Slim::getImages($input)[0];
        $imgname = $avatar['input']['name'];
        $ext     = pathinfo($imgname, PATHINFO_EXTENSION);
        $upname  = time().'.'.$ext;
        $data    = $avatar['output']['data'];
        $file    = Slim::saveFile($data, $upname, public_path().'/img/'.$destination);

        return $file['name'];
	}

    /**
     * @return [array[day,days,hours,minuts]]
     * to return [day] when the company subscription will finish
     */
    public static function after()
    {
        $currentTime = strtotime(\Carbon\Carbon::now());
        $expire_date = Auth::user()->company->expire_date;
        $diffTime    = $expire_date - $currentTime;

        $day         = date('d M Y', $expire_date);
        $days        = floor(date('d', $diffTime)-1);
        $hours       = date('H', $diffTime);
        $minutes     = date('i', $diffTime);

        return ['day' => $day,'days' => $days, 'hours' => $hours, 'minutes' => $minutes];
    }
}