<?php
namespace App\Uploads;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Images {
    public static function uploadImages($file)
    {
        $imageName = time().'.'.$file->extension();
        $fullPath = "images/{$imageName}";

        $image = Image::make($file)->encode('png', 90);
        $image->orientate();

        Storage::disk('s3')->put($fullPath, $image->stream());

        return env('APP_URL_IMAGE').'/'.$fullPath;
    }


    public static function uploadImageToStorage($file)
    {
        if($file){
            $imageName = md5(time()) . '.' . $file->extension();
            $path = Storage::url('public/images');
            $file->storeAs('public/images', $imageName);

            $images = $path.'/'.$imageName;

            return url('/').$images;
        }
        else{
            return '';
        }


    }

}
