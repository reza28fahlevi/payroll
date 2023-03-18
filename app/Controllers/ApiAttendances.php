<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AttendancesModel;

class ApiAttendances extends ResourceController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AttendancesModel();
    }

    // all data
    public function index(){
        $data['attendances'] = $this->model->orderBy('attendance_id', 'DESC')->findAll();

        return $this->respond($data);
    }
    // show data
    public function show($attendance_id = null){
        $data = $this->model->where('attendance_id',$attendance_id)->first();

        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound("No attendance found");
        }
    }
    // save data
    public function create()
    {
        $data = [
            'employee_id' => $this->request->getVar('employee_id',FILTER_SANITIZE_STRING),
            'time_in'  => $this->request->getVar('time_in',FILTER_SANITIZE_STRING),
            'time_out'  => $this->request->getVar('time_out',FILTER_SANITIZE_STRING),
            'date'  => $this->request->getVar('date',FILTER_SANITIZE_STRING),
        ];
        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data saved',
                'attendance_id' => $this->model->insertID()
            ]
        ];

        return $this->respond($response);
    }
    // update data
    public function update($attendance_id = null)
    {
        $data = [
            'employee_id' => $this->request->getVar('employee_id',FILTER_SANITIZE_STRING),
            'time_in'  => $this->request->getVar('time_in',FILTER_SANITIZE_STRING),
            'time_out'  => $this->request->getVar('time_out',FILTER_SANITIZE_STRING),
            'date'  => $this->request->getVar('date',FILTER_SANITIZE_STRING),
        ];
        $this->model->update($attendance_id, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Attendance updated successfully'
            ]
        ];

        return $this->respond($response);
    }
    // delete data
    public function delete($attendance_id = null)
    {
        $data = $this->model->where('attendance_id', $attendance_id)->delete($attendance_id);

        if($data){
            $this->model->delete($attendance_id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Attendance successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Attendance found');
        }
    }
}