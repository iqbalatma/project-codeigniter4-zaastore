<?php

namespace App\Controllers;

class Technician extends BaseController
{
    public function __construct()
    {
        parent::check_login();
        $this->technician_model = new \App\Models\TechnicianModel();
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




        $technician_done = $this->technician_model->getAllDataOrderByUserId("monthly", $this->session->get("id_user"), getMonthNow(), getYearNow());


        $data = [
            "title" => "Penugasan Teknisi",
            "content" => "view_technician",
            "flashdata" => $flashdata,
            "session" => $this->session->get(),
            "technician" => $this->technician_model->getDataOrderForTechnician($this->session->get("id_user")),
            "technician_done" => $technician_done,
            "technician_waiting_confirm" => $this->technician_model->getDataOrderForTechnicianWaitingConfirm($this->session->get("id_user")),
            "warehouse" => $this->warehouse->getAllData(),
            "history" => $this->warehouse_transaction,
        ];


        return view('view_technician/view_technician', $data);
    }


    public function by_technician()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 3 || $roleId == 4 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }

        $data_user_technician = $this->users_model->where('id_role', 4)->findAll();

        $data = [
            "title" => "Penugasan Teknisi",
            "content" => "view_by_technician",
            "session" => $this->session->get(),
            "user_technician" => $data_user_technician,
            "order_technician" => $this->technician_model,
        ];


        return view('view_technician/view_by_technician', $data);
    }

    public function all_technician()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 3 || $roleId == 4 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }

        $technician = $this->technician_model->getAllDataOrder();
        $data = [
            "title" => "Penugasan Teknisi",
            "content" => "view_all_technician",
            "flashdata" => $flashdata,
            "session" => $this->session->get(),
            "technician" => $technician,
            "user_technician" => $this->users_model,
            "technician_user" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
            "listTechnician" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
        ];


        return view('view_technician/view_all_technician', $data);
    }




    public function request_warehouse()
    {
        $current_time = date('Y-m-d H:i:s', time());
        $data = [
            "id" => $this->request->getPost("id_bahan_baku_request"),
            "quantity" => $this->request->getPost("quantity"),
            "jenis_transaksi" => "keluar",
            "update_at" => $current_time
        ];

        $dataTransaction = [
            "id_order" => $this->request->getPost("id_order_request"),
            "id_user" => $this->request->getPost("id_user_request"),
            "id_bahan_baku" => $this->request->getPost("id_bahan_baku_request"),
            "unit" => $this->request->getPost("unit"),
            "quantity" => $this->request->getPost("quantity"),
        ];

        $query = $this->warehouse_transaction->insert($dataTransaction);
        $query2 = $this->warehouse->updateQuantity($data);
        if ($query == true && $query2 == true) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
             Request Bahan Berhasil !
            </div>');
            return redirect()->back();
        }
    }

    public function report_product()
    {
        $image = $this->request->getFile('image_product');

        if ($image->getName() == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Upload gambar gagal !</div>');
            return redirect()->to("Technician");
        } else {
            $id_order = $this->request->getPost("id_order");
            $image_name = $image->getName();
            $data = [
                "image_product" => $image_name,
            ];
            $query = $this->technician_model->update($id_order, $data);
            if (ENVIRONMENT == "development") {
                $image->move(ROOTPATH . '/public/uploads/product');
            } else {
                $image->move(ROOTPATH . '../public_html/internal/uploads/product');
            }
            if ($query) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
                return redirect()->back();
            }
        }
    }

    public function update_technician()
    {
        $id_order = $this->request->getPost("id_order");
        $technician = $this->request->getPost("technician");

        $query_update_technician = $this->technician_model->update($id_order, ["id_technician" => $technician]);
        if ($query_update_technician) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Data teknisi berhasil diperbaharui !</div>');
            return redirect()->to("/technician-all");
        }
    }
}
