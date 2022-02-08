<?php

namespace App\Controllers;

class Status extends BaseController
{
    public function __construct()
    {
        parent::check_login();
        $this->status_model = new \App\Models\StatusModel();
    }



    // Description : Menampilkan table status desain
    public function design_print()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Print Desain",
            "content" => "view_status_design",
            "flashdata" => $flashdata,
            "status" => $this->status_model->getAllDataWaitingList(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
            "image_design" => $this->image_design_model,
        ];

        return view('view_status/view_status_design', $data);
    }


    // Description : Menampilkan table status production
    public function production()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Produksi",
            "content" => "view_status_production",
            "flashdata" => $flashdata,
            "status" => $this->status_model->getAllDataDesign(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
            "technician" => $this->users_model,
            "image_design" => $this->image_design_model,
        ];

        return view('view_status/view_status_production', $data);
    }

    public function packing()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Packing",
            "content" => "view_status_packing",
            "flashdata" => $flashdata,
            "status" => $this->status_model->getAllDataProduction(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
        ];

        return view('view_status/view_status_packing', $data);
    }

    public function checkout()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Checkout",
            "content" => "view_status_checkout",
            "flashdata" => $flashdata,
            "status" => $this->status_model->getAllDataPacking(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
            "image_design" => $this->image_design_model,
        ];

        return view('view_status/view_status_checkout', $data);
    }

    public function installation()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Installation",
            "content" => "view_status_installation",
            "flashdata" => $flashdata,
            "installer" => $this->users_model,
            "status" => $this->status_model->getAllDataInstallation(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
        ];

        return view('view_status/view_status_installation', $data);
    }


    // PROGRESS
    // PROGRESS
    // PROGRESS
    // PROGRESS
    // PROGRESS
    // PROGRESS



    public function update_status_design($id_order)
    {
        $query = $this->status_model->update($id_order, ["id_status" => 1]);
        if ($query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Status Berhasil Diperbaharui !</div>');
            return redirect()->back();
        }
    }

    public function update_status_production($id_order)
    {
        $date_production_done = date('Y-m-d H:i:s', time());
        $data = [
            "id_status" => 2,
            "date_production_done" => $date_production_done
        ];
        $query = $this->status_model->update($id_order, $data);


        if ($query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Status Berhasil Diperbaharui !</div>');
            return redirect()->back();
        }
    }



    public function update_status_packing($id_order)
    {
        $query = $this->status_model->update($id_order, ["id_status" => 3]);
        if ($query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Status Berhasil Diperbaharui !</div>');
            return redirect()->back();
        }
    }


    public function update_status_installation()
    {

        $id_order = $this->request->getPost("id_order");
        $date_installation_done = date('Y-m-d H:i:s', time());
        $data = [
            "installation_status" => 1,
            "date_installation_done" => $date_installation_done,
        ];
        $query = $this->status_model->update($id_order, $data);
        if ($query) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Status Berhasil Diperbaharui !</div>');
            return redirect()->back();
        }
    }

    public function update_status_checkout()
    {
        $image = $this->request->getFile('image');
        $id_order = $this->request->getPost("id_order");


        if ($image->getName() !== "") {
            if (ENVIRONMENT == "development") {
                $image->move(ROOTPATH . '/public/uploads/checkout');
            } else {
                $image->move(ROOTPATH . '../public_html/internal/uploads/checkout');
            }
            $query = $this->status_model->update($id_order, ["id_status" => 4, "checkout_image" => $image->getName()]);
            if ($query) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Status Berhasil Diperbaharui !</div>');
                return redirect()->back();
            }
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Tambah data gagal. Gambar belum ditambahkan !</div>');
            return redirect()->back();
        }
    }
}
