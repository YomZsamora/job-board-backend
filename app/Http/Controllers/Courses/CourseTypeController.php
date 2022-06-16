<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    function verifyCourseCurriculumAndType($course) {
        if(substr($course,0,2) === "SD" && $course[2] === "C") {
            $courseType = array("type" => "Software Development", "curriculum" => "Legacy");
            $courseObj = (object)$courseType;
            return $courseObj;
        } else if(substr($course,0,2) === "DS" && $course[2] === "C") {
            $courseType = array("type" => "Data Science", "curriculum" => "Legacy");
            $courseObj = (object)$courseType;
            return $courseObj;
        } else if(substr($course,0,2) === "SD" && $course[2] === "F") {
            $courseType = array("type" => "Software Development", "curriculum" => "Flatiron");
            $courseObj = (object)$courseType;
            return $courseObj;
        } else if(substr($course,0,2) === "DS" && $course[2] === "F") {
            $courseType = array("type" => "Data Science", "curriculum" => "Flatiron");
            $courseObj = (object)$courseType;
            return $courseObj;
        }
    }
}
