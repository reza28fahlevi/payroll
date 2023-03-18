<?php

namespace App\Controllers;

use App\Models\EmployeesModel;
use App\Models\ShiftModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new EmployeesModel();
        $employeeData = $model->orderBy('employee_id', 'DESC')->findAll();
        $data = [
            "data" => $employeeData
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
}
