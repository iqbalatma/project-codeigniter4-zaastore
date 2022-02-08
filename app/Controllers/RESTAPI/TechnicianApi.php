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

    public function showTechnicianOnProgress()
    {
        $dataTechnician = $this->technician_model->getAllDataOrder();
        return $this->respond($dataTechnician, 200);
    }

    public function showTechnicianName($idTechnician)
    {
        $technician_name = $this->user_model->get_technician($idTechnician)[0]["fullname"];
        return $this->respond($technician_name, 200);
    }
}
