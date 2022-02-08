<?php

namespace App\Controllers\RESTAPI;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;



class PaymentApi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::check_login();
        $this->payment_order_model = new \App\Models\PaymentOrderModel();
    }

    public function show($idOrder)
    {
        $dataPayment = $this->payment_model->where("id_order", $idOrder)->where("is_deleted", 0)->findAll();
        return $this->respond($dataPayment, 200);
    }



    public function showPaidOff($type = "", $month = "", $year = "")
    {
        $dataPayment = $this->payment_order_model->getDataPaidOff($type, $month, $year);
        return $this->respond($dataPayment, 200);
    }



    public function paymentLeft($idOrder)
    {
        $dataPayment  = $this->payment_model->where("id_order", $idOrder)->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
        return $this->respond($dataPayment, 200);
    }
}
