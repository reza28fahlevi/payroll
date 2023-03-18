<?php

namespace App\Controllers;

use App\Models\EmployeesModel;
use App\Models\ShiftModel;
use App\Models\AttendancesModel;

class PayrollController extends BaseController
{
    public function index(){
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

    public function report(){
        $modelEmployee = new EmployeesModel();
        $modelShift = new ShiftModel();
        $modelAttendance = new AttendancesModel();

        $data = (object) $this->request->getPost();
        $employee = $modelEmployee->find($data->employee_id);
        $employeeShift = $modelShift->find($employee->shift_id);
        for ($x = $employeeShift->shift_day_start; $x <= $employeeShift->shift_day_end; $x++){
            $workingDays[] = $x;
        };
        $start_date = date("Y-m-d",strtotime($data->year."-".$data->period."-01"));
        $end_date = date("Y-m-d",strtotime(date($data->year."-".$data->period."-t")));
        $totalWorkingDays = countAttendance($start_date,$end_date,$workingDays);

        $attendanceEmployee = $modelAttendance->totalPresence($data->employee_id, $totalWorkingDays['date'], $employeeShift->time_in);
        $salary = (int) $employee->salary;
        $total_working_days = (int) $totalWorkingDays['days_total'];
        $total_presence = (int) $attendanceEmployee['total_presence']->attendance_id;
        $late_total = (int) $attendanceEmployee['total_late']->attendance_id;
        $total_salary = $salary/$total_working_days*$total_presence-($late_total*50000);

        $datas = [
            "detail_employee" => $employee,
            "total_working_days" => $totalWorkingDays['days_total'],
            "total_salary" => (int) $total_salary,
            "total_late" => $late_total,
            "total_presence" => $total_presence
        ];
        // dd($datas);
        return view('Payroll/report_payroll',$datas);
    }

    public function payrolls(){
        $start = 1;
        $end = 6;
        for ($x = $start; $x <= $end; $x++){
            $workingDays[] = $x;
        };
        $date = countAttendance("2023-03-01","2023-03-31",$workingDays);
        dd($date);
    }
}