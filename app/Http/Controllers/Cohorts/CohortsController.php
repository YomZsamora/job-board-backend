<?php

namespace App\Http\Controllers\Cohorts;

use App\Http\Controllers\Controller;
use App\Models\Cohorts;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\DatesController;
use App\Http\Controllers\Courses\CourseTypeController;

class CohortsController extends Controller
{
    // Post New Cohort
    function addNewCohort(Request $request) {
        
        $dateFormat = new DatesController;
        $courseType = new CourseTypeController;

        $courseOfferingName = $request->courseOfferingname.$request->courseOfferingID; // Concatenate submitted Course Name and Course ID
        $courseCurriculumAndType = $courseType->verifyCourseCurriculumAndType($courseOfferingName);
        $cohortStartDate = $dateFormat->convertDateBeforePosting($request->cohortStartDate);
        $cohortGraduationDate = $dateFormat->convertDateBeforePosting($request->cohortGraduationDate);

        return response()->json(['status' => 200, 'cohortType' => $courseCurriculumAndType]);

        // $cohort = Cohorts::firstOrCreate([
        //     'cohort' => $courseOfferingName,
        //     'start_date' => $cohortStartDate,
        //     'end_date' => $cohortGraduationDate,
        // ]);
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
