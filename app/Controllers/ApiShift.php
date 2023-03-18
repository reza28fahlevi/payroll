<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ShiftModel;

class ApiShift extends ResourceController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ShiftModel();

    }

    // all data
    public function index(){
        $days = [
            "1" => "Monday",
            "2" => "Tuesday",
            "3" => "Wednesday",
            "4" => "Thursday",
            "5" => "Friday",
            "6" => "Saturday",
            "7" => "Sunday",
        ];
        $data['shifts'] = $this->model->orderBy('shift_id', 'DESC')->findAll();
        
        foreach($days as $key => $value){
            foreach($data['shifts'] as $keys => $shift){
                if($shift->shift_day_start == $key) $shift->shift_day_start = $value;
                if($shift->shift_day_end == $key) $shift->shift_day_end = $value;
            }
        }
        return $this->respond($data);
    }
    // show data
    public function show($shift_id = null){

        $data = $this->model->where('shift_id',$shift_id)->first();

        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound("No shift found");
        }
    }
    // save data
    public function create()
    {
        $data = [
            'shift_name' => $this->request->getVar('shift_name',FILTER_SANITIZE_STRING),
            'shift_day_start'  => $this->request->getVar('shift_day_start',FILTER_SANITIZE_STRING),
            'shift_day_end'  => $this->request->getVar('shift_day_end',FILTER_SANITIZE_STRING),
            'time_in'  => $this->request->getVar('time_in',FILTER_SANITIZE_STRING),
            'time_out'  => $this->request->getVar('time_out',FILTER_SANITIZE_STRING),
        ];
        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data saved',
                'shift_id' => $this->model->insertID()
            ]
        ];

        return $this->respond($response);
    }
    // update data
    public function update($shift_id = null)
    {
        $data = [
            'shift_name' => $this->request->getVar('shift_name',FILTER_SANITIZE_STRING),
            'shift_day_start'  => $this->request->getVar('shift_day_start',FILTER_SANITIZE_STRING),
            'shift_day_end'  => $this->request->getVar('shift_day_end',FILTER_SANITIZE_STRING),
            'time_in'  => $this->request->getVar('time_in',FILTER_SANITIZE_STRING),
            'time_out'  => $this->request->getVar('time_out',FILTER_SANITIZE_STRING),
        ];
        $this->model->update($shift_id, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Shift updated successfully'
            ]
        ];

        return $this->respond($response);
    }
    // delete data
    public function delete($shift_id = null)
    {
        $data = $this->model->where('shift_id', $shift_id)->delete($shift_id);

        if($data){
            $this->model->delete($shift_id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Shift successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No shift found');
        }
    }
}