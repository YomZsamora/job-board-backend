<?php

namespace App\Http\Controllers\Graduates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;

class GraduatesController extends Controller
{
    // Fetch Graduates for a Specific Cohort Provided the ID
    function getCohortGraduates($id){
        $graduates = Students::where('cohort', $id)->get();
        return response()->json(['status' => 200, 'graduates' => $graduates, 'noOfGraduates' => $graduates->count()]);
    }
}
