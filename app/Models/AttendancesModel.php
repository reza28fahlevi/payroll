<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendancesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'attendances';
    protected $primaryKey       = 'attendance_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["employee_id","time_in","time_out","date","created_at","updated_at","deleted_at"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'employee_id' => 'required',
        'date' => 'required'
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

    function totalPresence($employee_id, $date, $time_in){
        $builder = $this->db->table($this->table);
        $builder->selectCount('attendance_id');
        $builder->where("employee_id",$employee_id);
        $builder->where("deleted_at",NULL);
        $builder->where("time_in !=",NULL);
        $builder->where("time_out !=",NULL);
        $builder->whereIn("date",$date);
        $presence = $builder->get()->getRow();


        // dd($this->db->getLastQuery());
        $builder = $this->db->table($this->table);
        $builder->selectCount('attendance_id');
        $builder->where("employee_id",$employee_id);
        $builder->where("deleted_at",NULL);
        $builder->where("time_in >",$time_in);
        $builder->where("time_out !=",NULL);
        $builder->whereIn("date",$date);
        $late = $builder->get()->getRow();
        
        $result = [
            "total_presence" => $presence,
            "total_late" => $late
        ];
        return $result;
    }

}
