<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QrController extends Controller
{
    public function download($id) 
    {
        $employee = Employee::find($id);
        $qrpath = public_path("/storage/qrcode/".$employee->employee_id.".png");
        // return $qrpath;
        $filename = $employee->employee_id.".png";

        if (file_exists($qrpath))
        {
            // Send Download
            return Response::download($qrpath, $filename, [
                'Content-Length: '. filesize($qrpath)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }


    }
}
