<?php

namespace App\Controllers;

use App\Models\EmployeesModel;
use App\Models\ShiftModel;
use App\Models\AttendancesModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new EmployeesModel();
        $modelShift = new ShiftModel();
        $employeeData = $model->orderBy('employee_id', 'DESC')->findAll();
        $shiftData = $modelShift->orderBy('shift_name', 'ASC')->findAll();
        $data = [
            "data" => $employeeData,
            "shifts" => $shiftData
        ];
        return view('Employee/employees',$data);
    }

    public function shift()
    {
        $days = [
            "1" => "Monday",
            "2" => "Tuesday",
            "3" => "Wednesday",
            "4" => "Thursday",
            "5" => "Friday",
            "6" => "Saturday",
            "7" => "Sunday",
        ];
        $model = new ShiftModel();
        $shiftData = $model->orderBy('shift_id', 'DESC')->findAll();
        $data = [
            "data" => $shiftData
        ];
        return view('Shift/shift',$data);
    }

    public function attendance(){
        $model = new AttendancesModel();
        $modelEmployee = new EmployeesModel();
        $data['attendances'] = $model->join('employees','employees.employee_id = attendances.employee_id')->orderBy('attendance_id', 'DESC')->findAll();
        $data['employeeData'] = $modelEmployee->orderBy('employee_name', 'ASC')->findAll();
        // dd($data);
        return view('Attendance/index',$data);
    }

    public function payroll(){
        $months = [
            "1" => "January",
            "2" => "February",
            "3" => "March",
            "4" => "April",
            "5" => "May",
            "6" => "June",
            "7" => "July",
            "8" => "August",
            "9" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December",
        ];
        $modelEmployee = new EmployeesModel();
        $employeeData = $modelEmployee->orderBy('employee_name', 'ASC')->findAll();
        $data = [
            'employeeData' => $employeeData,
            'months' => $months,
        ];
        return view('Payroll/index',$data);
    }
}
