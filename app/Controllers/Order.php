<?php

namespace App\Controllers;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Order extends BaseController
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
            "title" => "Tambah Order",
            "content" => "view_add_order",
            "flashdata" => $flashdata,
            "warehouse" => $this->warehouse->getAllData(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),
        ];

        return view('view_order/view_add_order', $data);
    }

    public function list_order($data_type = "")
    {
        if ($_SESSION["role"] == 5 || $_SESSION["role"] == 4 || $_SESSION["role"] == 7) {
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
            case "waiting-list":
                $order = $this->order_model->getAllDataWaitingList();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio2');radiobtn.checked = true;</script>";
                break;
            case "design-done":
                $order = $this->order_model->getAllDataDesignOnly();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio3');radiobtn.checked = true;</script>";
                break;
            case "production-done":
                $order = $this->order_model->getAllDataProduction();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio5');radiobtn.checked = true;</script>";
                break;
            case "packing-done":
                $order = $this->order_model->getAllDataPacking();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio6');radiobtn.checked = true;</script>";
                break;
            case "checkout-done-by-month":
                $order = $this->order_model->getAllDataCheckoutByMonth($month, $year);
                $checked_button = "<script>radiobtn = document.getElementById('btnradio7');radiobtn.checked = true;</script>";
                break;
            case "checkout-done-all":
                $order = $this->order_model->getAllDataCheckout();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio7');radiobtn.checked = true;</script>";
                break;
            case "technician-assignment-done-all":
                $order = $this->order_model->getAllDataOrderForTechnicianDoneAssignment();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio4');radiobtn.checked = true;</script>";
                break;
            case "technician-assignment-done-by-month":
                $order = $this->order_model->getAllDataOrderForTechnicianDoneAssignmentByMonth($month, $year);
                $checked_button = "<script>radiobtn = document.getElementById('btnradio4');radiobtn.checked = true;</script>";
                break;
            case "all-data":
                $order = $this->order_model->getAllData();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio1');radiobtn.checked = true;</script>";
                break;
            case "all-data-by-month":
                $order = $this->order_model->getAllDataByMonth($month, $year);
                $checked_button = "<script>radiobtn = document.getElementById('btnradio1');radiobtn.checked = true;</script>";
                break;
            default:
                $order = $this->order_model->getAllData();
                $checked_button = "<script>radiobtn = document.getElementById('btnradio1');radiobtn.checked = true;</script>";
        }
        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }

        $validation = null;
        if ($this->session->getFlashdata('validation') !== null) {
            $validation = $this->session->getFlashdata('validation');
        }
        $data = [
            "title" => "List Order",
            "content" => "view_list_order2",
            "flashdata" => $flashdata,
            "flashdata2" => $validation, //lupa untuk apa crosscheck lagi aja
            "session" => $this->session->get(),
            "order" => $order,
            "unit" => $this->unit->findAll(),
            "technician" => $this->users_model,
            "payment" => $this->payment_model,
            "checked_button" => $checked_button,
            "data_type" => $data_type,
            "image_design" => $this->image_design_model
        ];

        // echo $month . $year;

        return view('view_order/view_list_order', $data);
    }





    public function add_order()
    {
        $id_role = $this->request->getPost("id_role");
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
        $total_price = 0;
        $item_price = 0;
        $extra_price = 0;
        if ($this->request->getPost("cb_instalation") == "on") {
            $installation_price = 0;
        } else {
            $installation_price = null;
        }
        $paid_amount = 0;


        // SET RULES
        if ($id_role == "3") {
            $validation->setRules([
                'cable_length' => ['label' => 'Panjang kabel', 'rules' => 'required', 'errors' => ['required' => 'Panjang kabel tidak boleh kosong !']],
                'faktur_code' => ['rules' => 'required', 'errors' => ['required' => 'Faktur tidak boleh kosong!']],
                'size_acrilic' => ['rules' => 'required', 'errors' => ['required' => 'Ukuran akrilik tidak boleh kosong!']],
                'font' => ['rules' => 'required', 'errors' => ['required' => 'Font tidak boleh kosong!']],
            ]);
        } else {
            $validation->setRules([
                'cable_length' => ['label' => 'Panjang kabel', 'rules' => 'required|numeric', 'errors' => ['required' => 'Panjang kabel tidak boleh kosong !', 'numeric' => 'Panjang kabel harus berupa angka dalam satuan centimeter !']],
                'faktur_code' => ['rules' => 'required', 'errors' => ['required' => 'Faktur tidak boleh kosong!']],
                'size_acrilic' => ['rules' => 'required', 'errors' => ['required' => 'Ukuran akrilik tidak boleh kosong!']],
                'font' => ['rules' => 'required', 'errors' => ['required' => 'Font tidak boleh kosong!']],
                'price' => ['rules' => 'required', 'errors' => ['required' => 'Harga barang tidak boleh kosong!']],
                'paid_amount' => ['rules' => 'required', 'errors' => ['required' => 'Jumlah bayar barang tidak boleh kosong!']],
            ]);
            $total_price = $this->request->getPost("total_price");
            $item_price = $this->request->getPost('price');
            $extra_price = $this->request->getPost("extra_price");

            if ($this->request->getPost("cb_instalation") == "on") {
                $installation_price = $this->request->getPost("installation_price");
            } else {
                $installation_price = null;
            }
            $paid_amount = $this->request->getPost("paid_amount");
        }



        // VALIDATION RUN
        if (!$validation->withRequest($this->request)->run()) {
            $validation = $this->validation->listErrors();
            $this->session->setFlashdata("msg", "<div class='alert alert-danger' role='alert'>
            $validation</div>");
            return redirect()->to('/add-order');
        } else {
            // ORDER CODE BISA PRE DAN REA
            // ORDER CODE GENERATOR
            $order_code_from_db = $this->order_model->last_row();
            if (count($order_code_from_db) != 0) {
                $order_code_from_db = $order_code_from_db[0]["order_code"];
                $counter_order_code = explode("-", $order_code_from_db);
                $counter_order_code = intval($counter_order_code[2]) + 1;
            } else {
                $counter_order_code = 1;
            }
            $order_code = $this->request->getPost("product_type") . "-" . $counter_order_code;


            //untuk deadline
            date_default_timezone_set('Asia/Jakarta');
            $deadline = "";
            if ($this->request->getPost("product_type") == "PRE-Nanolight" || $this->request->getPost("product_type") == "PRE-Neonbox" || $this->request->getPost("product_type") == "PRE-Huruf-Timbul") {
                $deadline = time() + (864000);
                $deadline = date('Y-m-d H:i:s', $deadline);
            } elseif ($this->request->getPost("product_type") == "PRE-Neonflex") {
                $deadline = time() + (604800);
                $deadline = date('Y-m-d H:i:s', $deadline);
            } else {
                $deadline = date('Y-m-d H:i:s', time());
            }






            // DATA ORDER
            $data_order = [
                "id_user" => $this->request->getPost('id_user'),
                "order_code" => $order_code,
                "deadline" => $deadline,
                "design_notes" => $this->request->getPost('design_notes'),
                "size_acrilic" => $this->request->getPost('size_acrilic'),
                "font" => $this->request->getPost('font'),
                "cable_length" => $this->request->getPost('cable_length'),
                "adaptor" => $this->request->getPost('adaptor'),
                "waterproof" => $this->request->getPost('waterproof'),
                "controller" => $this->request->getPost('quantity_controller'),
                "switch" => $this->request->getPost('quantity_switch'),
                "laser_cut" => $this->request->getPost('laser_cut'),
                "peniklan" => $this->request->getPost('quantity_peniklan'),
                "adhesive" => $this->request->getPost('quantity_adhesive'),
                "price" => $item_price,
                "extra_price" => $extra_price,
                "total_price" => $total_price,
                "installation_price" => $installation_price,
                "notes" => $this->request->getPost('notes'),
                "address" => $this->request->getPost('address'),
                "faktur_code" => $this->request->getPost('faktur_code'),
                "id_status" => 5,
                "source_order" => $this->request->getPost("source_order"),
            ];



            // PERHITUNGAN SISA BAYAR
            if ($installation_price == null) {
                $payment_left = $total_price - $paid_amount;
            } else {
                $payment_left = $total_price + $installation_price - $paid_amount;
            }


            $query_insert_order = $this->order_model->insert($data_order);

            $id_order_last_row = intval($this->order_model->last_row()[0]["id_order"]);


            // CHECK IMAGE DESAIN
            $image_design = $this->request->getFileMultiple("image");
            if (count($image_design) != 0) {
                for ($x = 0; $x < count($image_design); $x++) {
                    if ($image_design[$x]->getName() !== "") {
                        // PINDAHKAN IMAGE DESAIN KE FOLDER UPLOADS
                        if (ENVIRONMENT == "development") {
                            $image_design[$x]->move(ROOTPATH . '/public/uploads/desain');
                        } else {
                            $image_design[$x]->move(ROOTPATH . '../public_html/internal/uploads/desain');
                        }
                        $data_image_design = [
                            "is_deleted" => 0,
                            "image_name" => $image_design[$x]->getName(),
                            "id_order" => $id_order_last_row
                        ];

                        // insert ke tabel image_design
                        $query_insert_image_design = $this->image_design_model->insert($data_image_design);
                    }
                }
            }





            // data payment
            $data_payment = [
                "paid_amount" => $paid_amount,
                "payment_code" => "KODE PEMBAYARAN",
                "id_order" => $id_order_last_row,
                "payment_left" => $payment_left,
                "image_payment" => null,
            ];

            $image_payment = $this->request->getFile("image_payment");
            if ($image_payment != null) {
                $data_payment["image_payment"] = null;
                if ($image_payment->getName() !== "") {
                    if (ENVIRONMENT == "development") {
                        $image_payment->move(ROOTPATH . '/public/uploads/bukti_bayar');
                    } else {
                        $image_payment->move(ROOTPATH . '../public_html/internal/uploads/bukti_bayar');
                    }
                    $data_payment["image_payment"] = $image_payment->getName();
                }
            }

            // QUERY PAYMENT
            $query_payment = $this->payment_model->insert($data_payment);

            if ($query_insert_order) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                 Data Berhasil Ditambahkan !
                </div>');
                return redirect()->to('/add-order');
            }
        }
    }

    // Edit pada modal detail
    public function edit()
    {

        date_default_timezone_set('Asia/Jakarta');



        $id_order = $this->request->getPost("id_order");
        $kode_faktur = $this->request->getPost("faktur_code");
        $address = $this->request->getPost("address");
        $design_notes = $this->request->getPost("design_notes");
        $notes = $this->request->getPost("notes");
        $source_order = $this->request->getPost("source_order");
        $size_acrilic = $this->request->getPost("size_acrilic");
        $cable_length = $this->request->getPost("cable_length");
        $font = $this->request->getPost("font");
        $adaptor = $this->request->getPost("adaptor");
        $controller = $this->request->getPost("controller");
        $adhesive = $this->request->getPost("adhesive");
        $switch = $this->request->getPost("switch");
        $peniklan = $this->request->getPost("peniklan");
        $waterproof = $this->request->getPost("waterproof");
        $laser_cut = $this->request->getPost("laser_cut");
        $deadline = $this->request->getPost("deadline");


        $price = $this->request->getPost("price");
        $extra_price = $this->request->getPost("extra_price");
        $installation_price = $this->request->getPost("installation_price");
        if ($price == "") {
            $price = 0;
        }
        if ($extra_price == "") {
            $extra_price = 0;
        }
        if ($installation_price == "") {
            $installation_price = 0;
        }


        $total_price = $price + $extra_price;


        $deadline_explode = explode("/", $deadline);
        if (count($deadline_explode) != 1) {
            $year = $deadline_explode[2];
            $month = $deadline_explode[1];
            $day = $deadline_explode[0];
            $deadline = $year . "-" . $day . "-" . $month . " " . date('H:i:s', time());
        }


        if ($controller == 0) {
            $controller = null;
        }
        if ($adhesive == 0) {
            $adhesive = null;
        }
        if ($switch == 0) {
            $switch = null;
        }
        if ($peniklan == 0) {
            $peniklan = null;
        }




        $data = [
            "faktur_code" => $kode_faktur,
            "address" => $address,
            "design_notes" => $design_notes,
            "notes" => $notes,
            "source_order" => $source_order,
            "size_acrilic" => $size_acrilic,
            "cable_length" => $cable_length,
            "font" => $font,
            "adaptor" => $adaptor,
            "controller" => $controller,
            "adhesive" => $adhesive,
            "switch" => $switch,
            "peniklan" => $peniklan,
            "waterproof" => $waterproof,
            "laser_cut" => $laser_cut,
            "deadline" => $deadline,
            "price" => $price,
            "extra_price" => $extra_price,
            "installation_price" => $installation_price,
            "total_price" => $total_price,
        ];

        d($this->request->getPost());



        // insert ke payment
        $data_payment = [
            "paid_amount" => 0,
            "payment_code" => "KODE PEMBAYARAN",
            "id_order" => $id_order,
            "payment_left" => $price + $extra_price + $installation_price,
        ];

        $query_update_payment = $this->payment_model->update_payment($id_order);
        $query_payment = $this->payment_model->insert($data_payment);

        if ($installation_price == 0) {
            $data["installation_price"] = null;
        }

        $query_update_order = $this->order_model->update($id_order, $data);

        if ($query_update_order) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
               Data order berhasil diperbaharui !
                </div>');
            return redirect()->back();
        }
    }

    public function delete()
    {
        $id_order = $this->request->getPost("id_order");
        $query_delete_order = $this->order_model->update($id_order, ["is_deleted" => 1]);
        if ($query_delete_order) {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">
                 Data Berhasil Dihapus !
                </div>');
            return redirect()->back();
        }
    }


    public function add_image()
    {
        $id_order = $this->request->getPost("id_order");
        $image = $this->request->getFileMultiple("image");

        $tipe = $this->request->getPost("tipe");

        $data_order =  $this->order_model->where("id_order", $id_order)->findAll()[0]["image"];


        if (count($image) != 0) {
            $data["image"] = "";
            for ($x = 0; $x < count($image); $x++) {
                if ($image[$x]->getName() !== "") {
                    if (ENVIRONMENT == "development") {
                        $image[$x]->move(ROOTPATH . '/public/uploads/desain');
                    } else {
                        $image[$x]->move(ROOTPATH . '../public_html/internal/uploads/desain');
                    }
                    $data_order .= $image[$x]->getName() . "|";
                }
            }
        }



        $query_update_desain = $this->order_model->update($id_order, ["image" => $data_order]);
        if ($query_update_desain) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
               Gambar berhasil ditambahkan !
                </div>');
            if ($tipe == "status_desain") {
                return redirect()->to('/status-design');
            } else {
                return redirect()->back();
            }
        }
    }


    // Description : digunakan untuk menghapus atau menambahkan gambar desain
    // Note : update at belum di edit
    public function edit_image_design()
    {
        $query_insert_image_design = null;
        $query_delete_image_design = null;

        $id_order =  intval($this->request->getPost("id_order"));

        $file_image_design = $this->request->getFileMultiple("image");

        $id_image_design = $this->request->getPost("checkbox");



        if ($id_image_design != null) {
            for ($i = 0; $i < count($id_image_design); $i++) {
                $query_delete_image_design = $this->image_design_model->update($id_image_design[$i], ["is_deleted" => 8]);
            }
        }


        // CHECK IMAGE DESAIN
        if ($file_image_design != null) {
            if (count($file_image_design) != 0) {
                for ($x = 0; $x < count($file_image_design); $x++) {
                    if ($file_image_design[$x]->getName() !== "") {
                        // PINDAHKAN IMAGE DESAIN KE FOLDER UPLOADS
                        if (ENVIRONMENT == "development") {
                            $file_image_design[$x]->move(ROOTPATH . '/public/uploads/desain');
                        } else {
                            $file_image_design[$x]->move(ROOTPATH . '../public_html/internal/uploads/desain');
                        }
                        $data_image_design = [
                            "is_deleted" => 0,
                            "image_name" => $file_image_design[$x]->getName(),
                            "id_order" => $id_order
                        ];

                        // insert ke tabel image_design
                        $query_insert_image_design = $this->image_design_model->insert($data_image_design);
                    }
                }
            }
        }

        if ($query_insert_image_design != null || $query_delete_image_design != null) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">Gambar desain berhasil diperbaharui!</div>');
        } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger" role="alert">Perbaharui gambar gagal, tidak terjadi perubahan !</div>');
        }
        return redirect()->to("/status-design");
    }


    // BACKUP FUNGSI YANG BELUM TERPAKAI

    public function edit_deadline()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_order = $this->request->getPost("id_order");
        $deadline = $this->request->getPost("deadline");
        $deadline = explode("/", $deadline);
        $year = $deadline[2];
        $month = $deadline[1];
        $day = $deadline[0];
        $deadline = $year . "-" . $day . "-" . $month . " " . date('H:i:s', time());;

        $query_update_deadline = $this->order_model->update($id_order, ["deadline" => $deadline]);
        if ($query_update_deadline) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                 Deadline Berhasil Diperbaharui
                </div>');
            return redirect()->to("Order/list_order");
        }
    }
    public function edit_faktur()
    {

        $id_order = $this->request->getPost("id_order");
        $faktur_code = $this->request->getPost("faktur_code");


        $query_update_faktur = $this->order_model->update($id_order, ["faktur_code" => $faktur_code]);
        if ($query_update_faktur) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                 Faktur Berhasil Diperbaharui
                </div>');
            return redirect()->to("Order/list_order");
        }
    }

    public function edit_nominal()
    {

        $id_order = $this->request->getPost("id_order");
        $price = $this->request->getPost("price");
        $extra_price = $this->request->getPost("extra_price");
        $installation_price = $this->request->getPost("installation_price");


        $query_update_nominal = $this->order_model->update($id_order, [
            "price" => $price,
            "extra_price" => $extra_price,
            "total_price" => $price + $extra_price,
            "installation_price" => $installation_price,
        ]);

        // insert ke payment
        $data_payment = [
            "paid_amount" => 0,
            "payment_code" => "KODE PEMBAYARAN",
            "id_order" => $id_order,
            "payment_left" => $price + $extra_price + $installation_price,
        ];

        $query_update_payment = $this->payment_model->update_payment($id_order);
        $query_payment = $this->payment_model->insert($data_payment);

        if ($query_update_nominal) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
               Nominal berhasil diperbaharui
                </div>');
            return redirect()->to("Order/list_order");
        }
    }
}
