<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employees';
    protected $primaryKey       = 'employee_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["employee_name","employee_departement","employee_position","shift_id","salary","created_at","updated_at","deleted_at"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'employee_name' => 'required',
        'employee_departement' => 'required',
        'employee_position' => 'required'
    ];
    protected $validationMessages   = [
        'employee_name' => [
            'required' => 'Employee Name is required'
        ],
        'employee_departement' => [
            'required' => 'Employee Departement is required'
        ],
        'employee_position' => [
            'required' => 'Employee Position is required'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

}
