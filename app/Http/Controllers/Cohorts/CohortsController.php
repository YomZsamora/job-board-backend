<?php

namespace App\Http\Controllers\Cohorts;

use App\Http\Controllers\Controller;
use App\Models\Cohorts;
use App\Models\Students;

class CohortsController extends Controller
{
    // Fetch All Cohorts
    function getCohorts(){
        $cohorts = Cohorts::orderBy('end_date', 'DESC')->get();
        return response()->json(['status' => 200, 'cohorts' => $cohorts]);
    }

    // Fetch Graduates for a Specific Cohort Provided the ID
    function getCohortGraduates($id){
        $graduates = Students::where('cohort', $id)->get();
        return response()->json(['status' => 200, 'graduates' => $graduates, 'noOfGraduates' => $graduates->count()]);
    }
}
