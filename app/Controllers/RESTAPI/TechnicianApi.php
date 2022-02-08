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

    public function showTechnicianName($idTechnician)
    {
        $technician_name = $this->user_model->get_technician($idTechnician)[0]["fullname"];
        return $this->respond($technician_name, 200);
    }
}
