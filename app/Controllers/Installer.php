<?php

namespace App\Controllers;

class Installer extends BaseController
{
    public function __construct()
    {
        parent::check_login();
        $this->installation_model = new \App\Models\InstallationModel();
    }

    public function index()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 6 || $roleId == 5 || $roleId == 3 || $roleId == 1 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }

        $data = [
            "title" => "Pemasangan Lampu",
            "content" => "view_installer",
            "flashdata" => $flashdata,
            "session" => $this->session->get(),
            "installation" => $this->installation_model->getDataOrderForInstallation($this->session->get("id_user")),
            "installation_done" => $this->installation_model->getDataOrderForInstallationDoneThisMonth($this->session->get("id_user"), getMonthNow(), getYearNow()),
            "installation_waiting_confirm" => $this->installation_model->getDataOrderForInstallationWaitingConfirm($this->session->get("id_user")),
        ];
        return view('view_installer/view_installer', $data);
    }


    public function by_installer()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 3 || $roleId == 4 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }

        $data_user_technician = $this->users_model->where('id_role', 4)->findAll();
        $data = [
            "title" => "Penugasan Pemasangan",
            "content" => "view_by_installer",
            "session" => $this->session->get(),
            "listUser" => $data_user_technician,
            "order_installer" => $this->installation_model,
        ];

        return view('view_installer/view_by_installer', $data);
    }

    public function all_installer()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 3 || $roleId == 4 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }
        $installer = $this->installation_model->getAllDataOrder();

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Penugasan Pemasangan",
            "content" => "view_all_installer",
            "flashdata" => $flashdata,
            "session" => $this->session->get(),
            "installer" => $installer,
            "user_model" => $this->users_model,
            "listInstaller" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
        ];


        return view('view_installer/view_all_installer', $data);
    }






    public function report_installation()
    {
        $image = $this->request->getFile('installation_image');

        if ($image->getName() == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">
                     Upload gambar gagal ! 
                    </div>');
            return redirect()->back();
        } else {
            $id_order = $this->request->getPost("id_order");
            $image_name = $image->getName();
            $data = [
                "installation_image" => $image_name,
            ];
            $query = $this->installation_model->update($id_order, $data);
            if (ENVIRONMENT == "development") {
                $image->move(ROOTPATH . '/public/uploads/installation');
            } else {
                $image->move(ROOTPATH . '../public_html/internal/uploads/installation');
            }
            if ($query) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                         Data berhasil ditambahkan !
                        </div>');
                return redirect()->back();
            }
        }
    }


    public function update_installer()
    {
        $id_order = $this->request->getPost("id_order");
        $installer = $this->request->getPost("installer");

        $query_update_installer = $this->installation_model->update($id_order, ["id_installer" => $installer]);
        if ($query_update_installer) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Data installer berhasil diperbaharui !</div>');
            return redirect()->back();
        }
    }
}
