<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatesController extends Controller
{

    function convertDateBeforePosting($date){
        $time = strtotime($date);
        $newformat = date('Y-m-d',$time);
        return $newformat;
    }
}
