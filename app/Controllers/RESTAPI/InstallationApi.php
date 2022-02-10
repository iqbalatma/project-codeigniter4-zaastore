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
        $this->installer_model = new \App\Models\InstallationModel();
        $this->user_model = new \App\Models\UsersModel();
    }

    public function showDataOrderOnInstallation($type = "on-progress", $month = "", $year = "")
    {
        // on-progress
        // done-all
        // done-monthly (this month)
        // done-monthly (by filter)
        $dataInstallation = $this->installer_model->getAllDataOrder($type, $month, $year);
        return $this->respond($dataInstallation, 200);
    }

    public function showDataOrderByInstaller($type, $idInstaller, $month = "", $year = "")
    {
        $dataInstaller = $this->installer_model->getAllDataOrderByUserId($type, $idInstaller, $month, $year);
        return $this->respond($dataInstaller, 200);
    }

    public function showInstallerName($idInstaller)
    {
        $installerName = $this->user_model->get_technician($idInstaller)[0]["fullname"];
        return $this->respond($installerName, 200);
    }

    public function showAllInstaller()
    {
        $installer = $this->user_model->where("id_role", 4)->findAll();
        return $this->respond($installer, 200);
    }
}
