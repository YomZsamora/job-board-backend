<?php

namespace App\Http\Controllers\FileUploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadProcessingController extends Controller
{
    public function getRowsCount($fileName) {
        $row = 0;
        if (($handle = fopen(base_path("storage/app/public/uploads/" . $fileName), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
            }
            fclose($handle);
            return $row;
        }
    }

    public function validateCsvHeaders($fileName) {
        $report = fopen(base_path("storage/app/public/uploads/" . $fileName), "r");
        $requiredHeaders = array('First Name', 'Last Name', 'Email', 'Cohort', 'Track');
        $headers = fgetcsv($report, 0, ",");
        if($headers === $requiredHeaders) {
            return true;
        } else {
            return false;
        }
    }
}
