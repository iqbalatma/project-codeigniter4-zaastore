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

    public function showDataOrderByInstallerId($type, $idInstaller, $month = "", $year = "")
    {
        $dataInstaller = $this->installer_model->getAllDataOrderByUserId($type, $idInstaller, $month, $year);
        return $this->respond($dataInstaller, 200);
    }
}
