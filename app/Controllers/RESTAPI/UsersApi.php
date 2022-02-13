<?php

namespace App\Controllers\RESTAPI;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;



class UsersApi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::check_login();
        $this->user_model = new \App\Models\UsersModel();
    }

    public function showAllUsersByRoleId($idRole)
    {
        $installer = $this->user_model->where("id_role", $idRole)->findAll();
        return $this->respond($installer, 200);
    }

    public function showNameById($id)
    {
        $fullname = $this->user_model->getNameById($id)[0]["fullname"];
        return $this->respond($fullname, 200);
    }
}
