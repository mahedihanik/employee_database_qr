<?php

use App\Http\Helpers\GenerateQrCode;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\UserController;
use App\Http\Helpers\GenerateEmployeeId;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeVerificationController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\MonthlyAttendenceController;


require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('/employee', EmployeeController::class, ['only' => [
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy','myProfile'
]])->middleware('auth');

Route::resource('/user', UserController::class, ['only' => [
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]])->middleware('auth');

Route::resource('/attendence', AttendenceController::class,['only' => [
    'index','create'
    ]])->middleware('auth');

Route::resource('/monthly_attendence', MonthlyAttendenceController::class,['only' => [
    'index','create'
    ]])->middleware('auth');

Route::get('showmyprofile/{id}',[EmployeeController::class,'myProfile'])->name('employee.myProfile')->middleware('auth');
Route::get('showmyattendance/{id}',[EmployeeController::class,'myAttendance'])->name('employee.myAttendance')->middleware('auth');
Route::get('attendance_adjustment/{data}',[MonthlyAttendenceController::class,'attendanceAdjustment'])->middleware('auth');
Route::post('/wfh_attendance_adjustment',[MonthlyAttendenceController::class,'wfhAttendanceAdjustment'])->middleware('auth');


//route for remarks
Route::post('store',[EmployeeController::class,'storecomment']);

//Export PDF
Route::get('exportpdf/{id}',[EmployeeController::class,'generatePDF'])->name('exportpdf');

//Export excel
Route::get('exportexcel/{id}',[EmployeeController::class,'exportExcel'])->name('exportexcel');



Route::get('/qrdownload/{id}', [QrController::class, 'download'])->name('qrdownload');

Route::get('/employee/verification/{id}', [EmployeeVerificationController::class, 'verifyData'])->name('employee.verify');



//Route Import file
//Route::post('/attendence/create',[AttendenceController::class,'import'])->name('attendence.import');

//Route Import file for monthly attendence
Route::post('/attendence/create',[MonthlyAttendenceController::class,'import'])->name('monthly_attendence.import');


