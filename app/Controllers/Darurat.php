<?php

namespace App\Controllers;



class Darurat extends BaseController
{
    public function __construct()
    {
        parent::check_login();
    }

    public function index()
    {
        $id_role = $_SESSION["role"];
        if ($id_role == 5 || $id_role == 4 || $id_role == 6 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }



        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }

        $data = [
            "title" => "Darurat",
            "content" => "view_darurat",
            "flashdata" => $flashdata,
            "warehouse" => $this->warehouse->getAllData(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
            "order" => $this->order_model->where("id_technician", 16)->findAll(),
            // "order" => $this->order_model->findAll(),
            "technician" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
        ];

        return view('template_dashboard/wrapper', $data);
    }

    public function edit_item()
    {
        var_dump($this->request->getPost());
        $id_order = $this->request->getPost("id_order");
        $technician = $this->request->getPost("technician");

        $query = $this->order_model->update($id_order, ["id_technician" => $technician]);
    }
}
