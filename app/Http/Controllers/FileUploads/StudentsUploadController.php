<?php

namespace App\Http\Controllers\FileUploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Cohorts;
use App\Http\Controllers\FileUploads\UploadProcessingController;
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

            // Validate Headers
            $checkHeaders = new UploadProcessingController;
            $passedHeadersCheck = $checkHeaders->validateCsvHeaders($fileName);

            if($passedHeadersCheck) {
                // Get No of Rows
                $rows = new UploadProcessingController;
                $row_count = $rows->getRowsCount($fileName);                

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
                                    "employment_status" => 'unemployed',
                                    "role_id" => 4,
                                    'password' => Hash::make('Grad@moringa1234!'), 
                                ]);  
                            } else {
                                return response()->json(['status' => 422, 'title' => 'Cohort Not Found!', 'message' => 'Cohort ' . $data['3'] . " could not be found! Please ensure a cohort has been added before bulk upload. Click below to create a cohort now.", 'buttonText' => 'Add ' . $data['3'] . ' Cohort' ]);
                            }
                        }
                        $dataRow = false;
                    }
                    fclose($report);
                } catch (\Illuminate\Database\QueryException $exception) {
                    $errorInfo = $exception->errorInfo;
                    return response()->json(['status' => 500, 'message' => $errorInfo[2]]);
                }
                return response()->json(['status' => 200, 'message' => $row_count-1 . ' students have successfully been added to records!']);

            } else {
                return response()->json(['status' => 500, 'message' => 'Error Importing! Check that the CSV File is in the correct format!']);
            }
        }
    }
}
