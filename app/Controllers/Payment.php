<?php

namespace App\Controllers;


class Payment extends BaseController
{
    public function __construct()
    {
        parent::check_login();
        $this->payment_order_model = new \App\Models\PaymentOrderModel();
    }

    public function index()
    {
        $roleId = $_SESSION["role"];
        if ($roleId == 5 || $roleId == 4 || $roleId == 3 || $roleId == 7) {
            return redirect()->to("HttpRequest");
        }

        $order_data = $this->payment_order_model->getDataPaidOff("monthly", getMonthNow(), getYearNow());

        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => "Pembayaran",
            "content" => "view_payment",
            "flashdata" => $flashdata,
            "order_data" => $order_data,
            "order_data_on_progress" => $this->payment_order_model->getAllData(),
            "session" => $this->session->get(),
            "payment" => $this->payment_model,
        ];

        return view('view_payment/view_payment', $data);
    }




    public function payment_transaction()
    {
        $id_order = $this->request->getPost("id_order");
        $paid_amount = $this->request->getPost("paid_amount");
        $payment_left =  $this->payment_model->where("id_order", $id_order)->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
        $payment_left = $payment_left - $paid_amount;
        $data_payment = [
            "payment_code" => "ini adalah payment code yang belum di generate",
            "id_order" => $id_order,
            "paid_amount" => $paid_amount,
            "payment_left" => $payment_left,
        ];

        $image3 = $this->request->getFile("image_payment");
        if ($image3 != null) {
            $data_payment["image_payment"] = null;
            if ($image3->getName() !== "") {
                if (ENVIRONMENT == "development") {
                    $image3->move(ROOTPATH . '/public/uploads/bukti_bayar');
                } else {
                    $image3->move(ROOTPATH . '../public_html/internal/uploads/bukti_bayar');
                }
                $data_payment["image_payment"] = $image3->getName();
            }
        }



        $query_insert_payment = $this->payment_model->insert($data_payment);

        if ($payment_left <= 0) {
            $date_paid_off = date('Y-m-d H:i:s', time());;
            $query_update_date_paid_off = $this->payment_order_model->update($id_order, ["date_paid_off" => $date_paid_off]);
        }


        if ($query_insert_payment) {
            $this->session->setFlashdata('msg', '<div class="alert alert-success" role="alert">
                 Transaksi Berhasil Dilakukan
                </div>');
            return redirect()->to("/payment");
        }
    }
}
