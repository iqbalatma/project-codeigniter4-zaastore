<?php

namespace App\Controllers\RESTAPI;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;



class InstallationApi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::check_login();
        $this->installation_model = new \App\Models\InstallationModel();
        $this->user_model = new \App\Models\UsersModel();
    }

    public function showDataOrderOnInstallation($type = "on-progress", $month = "", $year = "")
    {
        // on-progress
        // done-all
        // done-monthly (this month)
        // done-monthly (by filter)
        $dataTechnician = $this->installation_model->getAllDataOrder($type, $month, $year);
        return $this->respond($dataTechnician, 200);
    }

    public function showInstallerName($idInstaller)
    {
        $installerName = $this->user_model->get_technician($idInstaller)[0]["fullname"];
        return $this->respond($installerName, 200);
    }
}
