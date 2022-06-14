<?php

namespace App\Http\Controllers\Cohorts;

use App\Http\Controllers\Controller;
use App\Models\Cohorts;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\DatesController;

class CohortsController extends Controller
{
    // Post New Cohort
    function addNewCohort(Request $request) {
        
        $dateFormat = new DatesController;

        $courseOfferingName = $request->courseOfferingname.$request->courseOfferingID; // Concatenate submitted Course Name and Course ID
        $cohortStartDate = $dateFormat->convertDateBeforePosting($request->cohortStartDate);
        $cohortGraduationDate = $dateFormat->convertDateBeforePosting($request->cohortGraduationDate);

        $cohort = Cohorts::firstOrCreate([
            'cohort' => $courseOfferingName,
            'start_date' => $cohortStartDate,
            'end_date' => $cohortGraduationDate,
        ]);
        // if($cohort) {
        //     return response()->json(['status' => 200, 'cohorts' => 'Cohort Found!']);
        // } else {
        //     return response()->json(['status' => 200, 'cohorts' => 'Cohort Not Found!']);
        // }
    }
    
    
    // Fetch All Cohorts
    function getCohorts(){
        $cohorts = Cohorts::orderBy('end_date', 'DESC')->get();
        return response()->json(['status' => 200, 'cohorts' => $cohorts]);
    }
}
