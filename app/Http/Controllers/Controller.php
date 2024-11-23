<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function success($message, $route){
        return redirect()->route($route)->with('success', $message);
    }
    public static function error($message)
    {
        return redirect()->back()->with('error', $message);
    }
}
