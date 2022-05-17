<?php

namespace App\Http\Controllers\FileUploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Cohorts;
use Illuminate\Support\Facades\Hash;

class StudentsUploadController extends Controller
{
    public function studentBulkUpload(Request $req) {
        if($req->hasFile('fileToUpload')) {
            $file = $req->file('fileToUpload');
            $fileName = $file->getClientOriginalName();
            $fileName = date('Y-m-d H:i:s') . $fileName;
            $req->file('fileToUpload')->storeAs('uploads', $fileName, 'public');

            $report = fopen(base_path("storage/app/public/uploads/" . $fileName), "r");
            $dataRow = true;

            try {
                while (($data = fgetcsv($report, 4000, ",")) !== FALSE) {
                    if (!$dataRow) {
                        $cohortExists = Cohorts::where('cohort', $data['3'])->first();
                        if ($cohortExists) {
                            Students::create([
                                "first_name" => $data['0'],
                                "last_name" => $data['1'],
                                "email" => $data['2'],
                                "cohort" => $cohortExists->id,
                                "track" => $data['4'],
                                "role_id" => 4,
                                'password' => Hash::make('password'), 
                            ]);  
                        }
                    }
                    $dataRow = false;
                }
                return response()->json(['status' => 500, 'title' => 'Cohort Not Found!', 'message' => 'Cohort ' . $data['3'] . "Can't be found!"]);
                fclose($report);
            } catch (\Illuminate\Database\QueryException $exception) {
                $errorInfo = $exception->errorInfo;
                return response()->json(['status' => 500, 'errors' => $errorInfo, 'title' => 'Duplicate Detected!', 'message' => 'Students have successfully been added to records!']);
            }
            return response()->json(['status' => 200, 'title' => 'File Uploaded!', 'message' => 'Students have successfully been added to records!']);
        }
    }
}
