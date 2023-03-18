<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeesModel;

class ApiPayroll extends ResourceController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new EmployeesModel();
    }

    // all data
    public function index(){
        $data['employees'] = $this->model->orderBy('employee_id', 'DESC')->findAll();

        return $this->respond($data);
    }
    // show data
    public function show($employee_id = null){
        $data = $this->model->where('employee_id',$employee_id)->first();

        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound("No employee found");
        }
    }
    // save data
    public function create()
    {
        $data = [
            'employee_name' => $this->request->getVar('employee_name',FILTER_SANITIZE_STRING),
            'employee_departement'  => $this->request->getVar('employee_departement',FILTER_SANITIZE_STRING),
            'employee_position'  => $this->request->getVar('employee_position',FILTER_SANITIZE_STRING),
        ];
        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data saved',
                'employee_id' => $this->model->insertID()
            ]
        ];

        return $this->respond($response);
    }
    // update data
    public function update($employee_id = null)
    {
        $data = [
            'employee_name' => $this->request->getVar('employee_name',FILTER_SANITIZE_STRING),
            'employee_departement'  => $this->request->getVar('employee_departement',FILTER_SANITIZE_STRING),
            'employee_position'  => $this->request->getVar('employee_position',FILTER_SANITIZE_STRING),
        ];
        $this->model->update($employee_id, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Employee updated successfully'
            ]
        ];

        return $this->respond($response);
    }
    // delete data
    public function delete($employee_id = null)
    {
        $data = $this->model->where('employee_id', $employee_id)->delete($employee_id);

        if($data){
            $this->model->delete($employee_id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No employee found');
        }
    }
}