<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class FileUploadController extends Controller
{
    public function fileUpload(Request $req){

        if($req->hasFile('fileToUpload')) {
            $file = $req->file('fileToUpload');
            $fileName = $file->getClientOriginalName();
            $fileName = date('Y-m-d H:i:s') . $fileName;
            $req->file('fileToUpload')->storeAs('uploads', $fileName, 'public');

            $report = fopen(base_path("storage/app/public/uploads/2022-05-14 20:15:10Test_CSV.csv"), "r");
            $dataRow = true;

            try {
                while (($data = fgetcsv($report, 4000, ",")) !== FALSE) {
                    if (!$dataRow) {
                        Test::create([
                            "name" => $data['0'],
                            "email" => $data['1']
                        ]);    
                    }
                    $dataRow = false;
                }
                fclose($report);
            } catch (\Illuminate\Database\QueryException $exception) {
                $errorInfo = $exception->errorInfo;
                return response()->json(['status' => 500, 'errors' => $errorInfo, 'title' => 'Duplicate Detected!', 'message' => 'Students have successfully been added to records!']);
            }
            
            
            return response()->json(['status' => 200, 'title' => 'File Uploaded!', 'message' => 'Students have successfully been added to records!']);
        }
   }
}
