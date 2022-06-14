<?php

namespace App\Http\Controllers\Cohorts;

use App\Http\Controllers\Controller;
use App\Models\Cohorts;
use Illuminate\Http\Request;

class CohortsController extends Controller
{
    // Post New Cohort
    function addNewCohort(Request $request) {
        return response()->json(['status' => 200, 'cohorts' => $request->cohortGraduationDate]);
    }
    
    
    // Fetch All Cohorts
    function getCohorts(){
        $cohorts = Cohorts::orderBy('end_date', 'DESC')->get();
        return response()->json(['status' => 200, 'cohorts' => $cohorts]);
    }
}
