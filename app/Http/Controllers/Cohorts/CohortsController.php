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

        $foundCohort = Cohorts::firstWhere('cohort', $courseOfferingName);

        if($foundCohort) {
            return response()->json(['status' => 422, 'cohort' => $foundCohort->cohort, 'message' => "Failed Adding Cohort! ".$foundCohort->cohort." Already Exists"]);
        } else {
            $cohort = Cohorts::Create([
                'cohort' => $courseOfferingName,
                'start_date' => $cohortStartDate,
                'end_date' => $cohortGraduationDate,
                'curriculum' => $courseCurriculumAndType->curriculum,
                'course' => $courseCurriculumAndType->type
            ]);
            return response()->json(['status' => 200, 'cohort' => $cohort, 'message' => 'Cohort DSF-PT3 has been Created Successfully!']);
        }
    }
    
    
    // Fetch All Cohorts
    function getCohorts(){
        $cohorts = Cohorts::orderBy('end_date', 'DESC')->get();
        return response()->json(['status' => 200, 'cohorts' => $cohorts]);
    }
}
