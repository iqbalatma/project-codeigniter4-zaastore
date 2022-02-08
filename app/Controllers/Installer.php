<?php

namespace App\Controllers;

class Installer extends BaseController
{
    public function __construct()
    {
        parent::check_login();
        $this->installation_model = new \App\Models\InstallationModel();
    }

    public function index($data_type = "done-this-month")
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 5 || $_SESSION["role"] == 3 || $_SESSION["role"] == 1 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $month = "";
        $year = "";
        if ($this->request->getGet("year") !== null) {
            $year = $this->request->getGet("year");
        }
        if ($this->request->getGet("month") !== null) {
            $month = $this->request->getGet("month");
        }

        if ($data_type == "done-this-month") {
            $installation_done = $this->installation_model->getDataOrderForInstallationDoneThisMonth($this->session->get("id_user"), $month, $year);
        } else {
            $installation_done = $this->installation_model->getDataOrderForInstallationDone($this->session->get("id_user"));
        }

        $data = [
            "title" => "Pemasangan Lampu",
            "content" => "view_installer",
            "flashdata" => $flashdata,
            "session" => $this->session->get(),
            "installation" => $this->installation_model->getDataOrderForInstallation($this->session->get("id_user")),
            "installation_done" => $installation_done,
            "installation_waiting_confirm" => $this->installation_model->getDataOrderForInstallationWaitingConfirm($this->session->get("id_user")),
            "warehouse" => $this->warehouse->getAllData(),
            "history_transaction" => $this->warehouse_transaction->getAllDataForTechnician(1),
            "history" => $this->warehouse_transaction,
            "data_type" => $data_type
        ];


        return view('view_installer/view_installer', $data);
    }


    public function by_installer($data_type = "done-this-month")
    {
        if ($_SESSION["role"] == 3 || $_SESSION["role"] == 4 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $month = "";
        $year = "";
        if ($this->request->getGet("year") !== null) {
            $year = $this->request->getGet("year");
        }
        if ($this->request->getGet("month") !== null) {
            $month = $this->request->getGet("month");
        }
        $checked_button = "";
        $technician = [];

        $data_user_technician = $this->users_model->where('id_role', 4)->findAll();

        $data = [
            "title" => "Penugasan Pemasangan",
            "content" => "view_by_installer",
            "session" => $this->session->get(),
            "technician" => [],
            "user_technician" => $data_user_technician,
            "name_technician" => $this->users_model,
            "order_installer" => $this->installation_model,
            "checked_button" => $checked_button,
            "data_type" => $data_type,
            "month" => $month,
            "year" => $year,
        ];


        return view('view_installer/view_by_installer', $data);
    }

    public function all_installer($data_type = "on-progress")
    {
        if ($_SESSION["role"] == 3 || $_SESSION["role"] == 4 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $month = "";
        $year = "";
        if ($this->request->getGet("year") !== null) {
            $year = $this->request->getGet("year");
        }
        if ($this->request->getGet("month") !== null) {
            $month = $this->request->getGet("month");
        }


        switch ($data_type) {
            case "on-progress":
                $installer = $this->installation_model->getAllDataOrderForInstallerOnProgress();
                $checked_button = "<script>
    radiobtn = document.getElementById('btnradio1');
    radiobtn.checked = true;
</script>";
                break;
            case "done-all":
                $installer = $this->installation_model->getAllDataOrderForInstallerDone();
                $checked_button = "<script>
    radiobtn = document.getElementById('btnradio2');
    radiobtn.checked = true;
</script>";
                break;
            case "done-this-month":
                $installer = $this->installation_model->getAllDataOrderForInstallerDoneThisMonth($month, $year);
                $checked_button = "<script>
    radiobtn = document.getElementById('btnradio2');
    radiobtn.checked = true;
</script>";
                break;
        }

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
            "user_technician" => $this->users_model,
            "checked_button" => $checked_button,
            "data_type" => $data_type,
            "installer_user" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
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
