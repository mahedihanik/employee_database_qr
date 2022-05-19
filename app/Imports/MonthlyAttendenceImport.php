<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class MonthlyAttendenceImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    *@return \Illuminate\Database\Eloquent\Model|null
    */
    
    
        public function model(array $row)
        {
            
            try{
                DB::table('monthly_attendences')->insert(
                    [                       
                        'emp_no'=>$row['emp_no'],
                        'ac_no'=>$row['ac_no'],
                        'no'=>$row['no'],
                        'name' => $row['name'],
                        'auto_assign' => $row['auto_assign'],
                        'date' =>$this->formateExcelDate($row['date']),
                        'timetable' =>$row['timetable'],
                        'on_duty' =>$this->formateExcelTime($row['on_duty']),
                        'off_duty' =>$this->formateExcelTime($row['off_duty']),
                        'clock_in' =>$this->formateExcelTime($row['clock_in']),
                        'clock_out' =>$this->formateExcelTime($row['clock_out']),
                        'normal' =>$row['normal'],
                        'real_time' =>$row['real_time'],
                        'late' =>$this->formateExcelTime($row['late']),
                        'early' =>$this->formateExcelTime($row['early']),
                        'absent' =>$this->absentInsert($row['absent']),
                        'ot_time' =>$this->formateExcelTime($row['ot_time']),
                        'work_time' =>$this->formateExcelTime($row['work_time']),
                        'exception' =>$row['exception'],
                        'must_cin' =>$row['must_cin'],
                        'must_cout' =>$row['must_cout'],
                        'department' =>$row['department'],
                        'ndays' =>$row['ndays'],
                        'weekend' =>$row['weekend'],
                        'holiday' =>$row['holiday'],
                        'att_time' =>$this->formateExcelTime($row['att_time']),
                        'ndays_ot' =>$this->formateExcelTime($row['ndays_ot']),
                        'weekend_ot' =>$row['weekend_ot'],
                        'holiday_ot' =>$row['holiday_ot'],
                    ]
                    );
           }catch(\Exception $e){
                echo $e;
                exit;
            }    
        }

    
    private function formateExcelTime($value2){

        $UNIX_DATE = ($value2- 25569) * 86400;

        $returnValue2 =  gmdate("H:i", $UNIX_DATE);

        return $returnValue2;
    }
    private function formateExcelDate($value){

        $UNIX_DATE = ($value- 25569) * 86400;

        $returnValue =  gmdate("d-M-Y", $UNIX_DATE);

        return $returnValue;
    }

    private function absentInsert($temp1)
    {
        
        if($temp1=="TRUE")
          {
           return 1;
          }
           
          elseif($temp1==null)
          {
            return 0;
          }

    }


}
