<?php

namespace App\Controllers\RESTAPI;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;



class TechnicianApi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::check_login();
        $this->technician_model = new \App\Models\TechnicianModel();
        $this->user_model = new \App\Models\UsersModel();
    }

    public function showDataOrderOnTechnician($type = "on-progress", $month = "", $year = "")
    {
        // on-progress
        // done-all
        // done-monthly (this month)
        // done-monthly (by filter)
        $dataTechnician = $this->technician_model->getAllDataOrder($type, $month, $year);
        return $this->respond($dataTechnician, 200);
    }

    public function showDataOrderByTechnicianId($type, $idTechnician, $month = "", $year = "")
    {
        $dataTechnician = $this->technician_model->getAllDataOrderByUserId($type, $idTechnician, $month, $year);
        return $this->respond($dataTechnician, 200);
    }


    /**
     * Use to get technician name by id
     */
    public function showTechnicianName($idTechnician)
    {
        $technician_name = $this->user_model->get_technician($idTechnician)[0]["fullname"];
        return $this->respond($technician_name, 200);
    }


    /**
     * Use to get data technician by user 
     */
    public function showAllTechnician()
    {
        $technicians = $this->user_model->where("id_role", 4)->findAll();
        return $this->respond($technicians, 200);
    }
}
