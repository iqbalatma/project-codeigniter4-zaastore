<?php

namespace App\Controllers;

class Assignment extends BaseController
{
    /*
        AUTHOR      : Iqbal Atma Muliawan
        CONTROLLER  : Assignment
        METHOD      :   -__construct()
                        -index()
                        -progress_technician_assignment()
                        -progress_technician_assignment_installation()
        DESCRIPTION : Controller ini digunakan untuk melakukan penugasan satu produk kepada teknisi untuk dikerjakan
        TODO        : 
    */


    // Description : Method yang pertama tama dijalankan untuk melakukan check apakah sudah login atau belum
    public function __construct()
    {
        //untuk melakukan check user login
        parent::check_login();

        $this->assignment_model = new \App\Models\AssignmentModel();
    }


    // Description : Method ini digunakan untuk melihat pada tabel apa saja yang dapat ditugaskan
    public function index()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }
        //untuk flash data dan menampilkan pesan
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }

        //data index assignment
        $data = [
            "title" => "Penugasan Teknisi",
            "content" => "view_assignment",
            "flashdata" => $flashdata,
            "assignment" => $this->assignment_model->getAllDataAssignment(),
            "assignment_installation" => $this->assignment_model->getAllDataAssignmentInstallation(),
            "technician" => $this->users_model->where("id_role", 4)->where("is_deleted", 0)->findAll(),
            "image_design" => $this->image_design_model,
        ];
        return view('view_assignment/view_assignment', $data);
    }


    //Description : Method ini digunakan untuk melakukan penugasan teknisi pada satu order
    public function progress_technician_assignment()
    {
        $id_technician = $this->request->getPost("technician");
        $id_order = $this->request->getPost("id_order");

        // query untuk update data assignment
        $query_update_assignment = $this->assignment_model->update($id_order, ["id_technician" => $id_technician]);


        //flashdata
        if ($query_update_assignment) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Teknisi Berhasil Ditugaskan !</div>');
            return redirect()->to("/assignment");
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Teknisi gagal ditugaskan !</div>');
            return redirect()->to("/assignment");
        }
    }


    //Description : Method ini digunakan untuk melakukan penugasan pemasangan produk
    public function progress_technician_assignment_installation()
    {
        $id_installer = $this->request->getPost("technician");
        $id_order = $this->request->getPost("id_order");

        $query_update_assignment = $this->assignment_model->update($id_order, ["id_installer" => $id_installer]);


        //flashdata
        if ($query_update_assignment) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Teknisi Berhasil Ditugaskan !</div>');
            return redirect()->to("/assignment");
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Teknisi gagal ditugaskan !</div>');
            return redirect()->to("/assignment");
        }
    }
}
