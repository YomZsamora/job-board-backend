<?php

namespace App\Http\Controllers\Cohorts;

use App\Http\Controllers\Controller;
use App\Models\Cohorts;
use App\Models\Students;

class CohortsController extends Controller
{
    function getCohorts(){
        $cohorts = Cohorts::orderBy('end_date', 'DESC')->get();
        return response()->json(['status' => 200, 'cohorts' => $cohorts]);
    }

    function getCohortGraduates($id){
        $graduates = Students::where('cohort', $id)->get();
        return response()->json(['status' => 200, 'graduates' => $graduates, 'noOfGraduates' => $graduates->count()]);
    }
}
