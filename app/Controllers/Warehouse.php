<?php

namespace App\Controllers;

class Warehouse extends BaseController
{

    /*
        AUTHOR      : Iqbal Atma Muliawan
        CONTROLLER  : Warehouse
        METHOD      :   -__construct()
                        -index()
                        -transaction()
                        -unit()
                        -add_item()
                        -edit_item()
                        -add_transaction()
                        -edit_transaction()
                        -add_unit()
                        -edit_unit()
        DESCRIPTION : Controller ini digunakan untuk melakukan login, logout, regis, dan lainnya berkaitan dengan akun.
        TODO        : DELETE UNIT
    */


    // Description : Construct pertama kali dijalankan untuk melakukan pengecekan check login
    public function __construct()
    {
        parent::check_login();
    }


    // Description : Menampilkan tampilan stok bahan baku
    public function index()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }


        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Gudang",
            "content" => "view_warehouse",
            "warehouse" => $this->warehouse->getAllData(),
            "unit" => $this->unit->findAll(),
            "flashdata" => $flashdata,
        ];
        return view('view_warehouse/view_warehouse', $data);
    }

    // Description : Menampilkan data transaction
    public function transaction()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Transaksi Gudang",
            "content" => "view_warehouse_transaction",
            "warehouse_transaction" => $this->warehouse_transaction->getAllData(),
            "warehouse" => $this->warehouse->findAll(),
            "flashdata" => $flashdata,
            "session" => $this->session->get()
        ];
        return view('view_warehouse/view_warehouse_transaction', $data);
    }

    // Description : menampilkan tampilan tabel unit
    public function unit()
    {
        if ($_SESSION["role"] == 6 || $_SESSION["role"] == 4 || $_SESSION["role"] == 3 || $_SESSION["role"] == 7) {
            return redirect()->to("HttpRequest");
        }


        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Unit",
            "content" => "view_warehouse_unit",
            "unit" => $this->unit->findAll(),
            "flashdata" => $flashdata

        ];
        return view('view_warehouse/view_warehouse_unit', $data);
    }


    // Description : progress menambahkan data bahan baku
    public function add_item()
    {
        if ($this->request->getPost("id_unit") == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Tambah Data Gagal ! Satuan Barang Belum Dipilih</div>');
            return redirect()->back();
        } else {
            $query = $this->warehouse->insert($this->request->getPost());
            if ($query) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Tambah Data Berhasil !</div>');
                return redirect()->to("/warehouse");
            }
        }
    }


    // Description : progress edit item ketika ada kesalahan
    public function edit_item()
    {
        $current_time = date('Y-m-d H:i:s', time());
        if ($this->request->getPost("id_unit") == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Edit Data Gagal</div>');
            return redirect()->back();
        } else {

            $data_item = [
                "fullname" => $this->request->getPost("fullname"),
                "id_unit" => $this->request->getPost("id_unit"),
                "quantity" => 0, //input pertama kuantitasnya harus nol
                "threshold" => $this->request->getPost("threshold"),
                "update_at" => $current_time,
                "is_deleted" => 0,
            ];
            $query_edit_item = $this->warehouse->update($this->request->getPost("id_bahan_baku"), $data_item);
            if ($query_edit_item) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Edit Data Berhasil</div>');
                return redirect()->to("/warehouse");
            }
        }
    }


    // Description : progress untuk menambahkan transaksi yang terjadi
    public function add_transaction()
    {
        $current_time = date('Y-m-d H:i:s', time());
        if ($this->request->getPost("id_bahan_baku") == null || $this->request->getPost("jenis_transaksi") == null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Data Transaksi Gagal Ditambahkan ! Data tidak boleh kosong !</div>');
            return redirect()->back();
        } else {
            $data = [
                "id" => $this->request->getPost("id_bahan_baku"),
                "quantity" => $this->request->getPost("quantity"),
                "jenis_transaksi" => $this->request->getPost("jenis_transaksi"),
                "update_at" => $current_time
            ];
            $query = $this->warehouse_transaction->insert($this->request->getPost());
            $query2 = $this->warehouse->updateQuantity($data);

            if ($query && $query2) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Data Transaksi Berhasil Ditambahkan !</div>');
                return redirect()->to("/warehouse-transaction");
            }
        }
    }


    // Description : Edit transaksi ketika ada kesalahan input oleh user
    public function edit_transaction()
    {
        $current_time = date('Y-m-d H:i:s', time());
        $id_transaction = $this->request->getPost("id_transaction");
        $id_bahan_baku = $this->request->getPost("id_bahan_baku");
        $quantity = $this->request->getPost("quantity");
        $jenis_transaksi = $this->request->getPost("jenis_transaksi2");
        $quantity_before = $this->request->getPost("quantity_before");





        if ($jenis_transaksi == "masuk") {
            $selisih = $quantity - $quantity_before;
        } else {
            $selisih = $quantity_before - $quantity;
        }



        $query_update_quantity = $this->warehouse->edit_quantity($id_bahan_baku, $selisih, $current_time);


        $query_update_transaksi = $this->warehouse_transaction->update($id_transaction, ["quantity" => $quantity, "jenis_transaksi" => $jenis_transaksi]);


        if ($query_update_transaksi && $query_update_quantity) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Data transaksi berhasil diedit !</div>');
            return redirect()->to("/warehouse-transaction");
        }
    }


    // Description : progress untuk menambahkan jenis unit atau satuan
    public function add_unit()
    {
        $query_add_unit = $this->unit->insert($this->request->getPost());
        if ($query_add_unit) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Unit Berhasil Ditambahkan !</div>');
            return redirect()->to("/warehouse-unit");
        }
    }


    // Description : progress untuk melakukan edit pada unit apabila terjadi kesalahan
    public function edit_unit()
    {
        $query_edit_unit = $this->unit->update($this->request->getPost("id_unit"), ["nama_unit" => $this->request->getPost("nama_unit")]);
        if ($query_edit_unit) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Unit Berhasil Diedit !</div>');
            return redirect()->to("/warehouse-unit");
        }
    }
}
