<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @param $message
     * @param string $level success, danger, info, default, warning
     * @param string $title
     */
    public function alert( $message, $type = "success")
    {
        app('request')->session()->flash('flash.alert.type',$type);
        app('request')->session()->flash('flash.alert.message', $message);
    }
}
