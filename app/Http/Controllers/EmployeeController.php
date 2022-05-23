<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MonthlyAttendence;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Helpers\GenerateQrCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\GenerateEmployeeId;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Controllers\MonthlyAttendenceController;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\UserAttendenceExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['active'] = isset($request['active']) ? 1 : 0;

        // $employee_id = GenerateEmployeeId::generate($request->joining_date);
        //$request['employee_password'] = Hash::make($request->employee_password);
        $employee_id = $request->employee_id;

//        if(isset($request['file'])) {
//            $fileName = $employee_id.'.'.$request->file->extension();
//
//            // $request->file->move(public_path('/images/employee'), $fileName);
//            $request->file('file')->storeAs('public/employee',$fileName);
//
//            $filePath = 'employee/' . $fileName;
//
//            $request['image'] = $filePath;
//
//
//
//
//        }
//
//        $request['employee_id'] = $employee_id;
//
//        $qrcodepath = GenerateQrCode::generate($request['employee_id']);
//
//        $request['qrimage'] = $qrcodepath;
        // return $request;
        Employee::create([
            'employee_id'=> $request->employee_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'designation'=>$request->designation,
            'personal_email'=>$request->personal_email,
            'official_email'=>$request->official_email,
            'personal_number'=>$request->personal_number,
            'official_number'=>$request->official_number,
            'joining_date'=>$request->joining_date,
            'home_address'=>$request->home_address,
            'ename'=>$request->ename,
            'ephone'=>$request->ephone,
            'erelation'=>$request->erelation,
            'gender'=>$request->gender,
            'company_name'=>$request->company_name,
            'employee_role'=>$request->employee_role,
            'dob'=>$request->dob,
            'blood_group'=>$request->blood_group,
            'marital_status'=>$request->marital_status,
            'image'=>$request->image,
            'qrimage'=>$request->qrimage,
            'expiry_date'=>$request->expiry_date,
            'active'=>$request->active
        ]);
        $employees = Employee::all()->last();

        $user = User::create([
            'name' => $request->name,
            'emp_id'=> $employees->id,
            'email' => $request->official_email,
            'password' => Hash::make($request->employee_password),
        ]);
        event(new Registered($user));

        return redirect()->route('employee.index');

       if(isset($request->remarks )){


       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        // 2022-03
        //  Mar-2022
        $month = $request->has('month') ? $request->month : null;

        $searchItem = date("M-Y",strtotime($request->month));

        $employee = Employee::find($id);
        $query=MonthlyAttendence::where('ac_no',$employee->employee_id);

        if(!is_null($month)){
            $query->where('date', 'LIKE', "%${searchItem}%");
        }
        $monthly_attendence = $query->get();

        // echo "<pre>";
        // print_r($monthly_attendence->toArray());
        // exit;

        $max_late_min = Setting::where('settings_key','max_late_min')->first()->value;
        $max_early_min = Setting::where('settings_key','max_early_min')->first()->value;

        // dd($max_late_min);

        // echo "<pre>";
        // print_r($monthly_attendence->toArray());
        // exit;
        return view('employee.show', compact('employee','monthly_attendence','max_late_min','max_early_min','month'));



        //$years = [];
        //for($year=2020; $year = 2030; $year++)
        //$years[$year] = $year;





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {

        $request['active'] = isset($request['active']) ? 1 : 0;

        if(isset($request['file'])) {
            $fileName = $request->employee_id.'.'.$request->file->extension();

            // $request->file->move(storage_path('/images/employee'), $fileName);

            // $request->image->storeAs('images/employee', $imageName);

            $path = $request->file('file')->storeAs('public/employee/',$fileName);



            // storage/app/images/file.png

            $filePath = 'employee/' . $fileName;

            $request['image'] = $filePath;
        }

        Employee::find($id)->update($request->all());

        return redirect()->route('employee.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);


        $qr_path = public_path("storage/".$employee->qrimage);
        $img_path = public_path("storage/".$employee->image);
        unlink($img_path);
        unlink($qr_path);


        Employee::destroy($id);

        return redirect()->route('employee.index');
    }

   // private function formateExcelTime($value2){

       // $UNIX_DATE = ($value2- 25569) * 86400;

       // $returnValue2 =  gmdate("H:i", $UNIX_DATE);

       // return $returnValue2;
    //}

    public function storecomment(Request $request){
        //dd($request);
        $monthly_attendence=MonthlyAttendence::find($request->id);
        $monthly_attendence->remarks=$request->input('remarks');
        $monthly_attendence->save();
        return redirect()->back()->with('status','Remarks added Successfully');



    }

    public function generatePDF($id){
        $employee = Employee::find($id);

        // echo($employee);
        // exit;

        $query=MonthlyAttendence::where('ac_no',$employee->employee_id)->get();
        $max_late_min = Setting::where('settings_key','max_late_min')->first()->value;
        $max_early_min = Setting::where('settings_key','max_early_min')->first()->value;
        // echo "<pre>";
        // print_r($query);
        // exit;
        $pdf=PDF::loadview('employee.pdf',compact('employee','query','max_late_min','max_early_min'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream("pdf_file.pdf");



    }

    public function exportExcel($id){

        return Excel::download(new UserAttendenceExport($id), 'export.xlsx');


    }



}
