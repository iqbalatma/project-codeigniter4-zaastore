<?php

namespace App\Controllers\RESTAPI;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;



class WarehouseTransactionApi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        parent::check_login();
        $this->warehouse_transaction_model = new \App\Models\WarehouseTransactionModel();
    }

    public function showAllByOrderId($orderId)
    {
        $transaction = $this->warehouse_transaction_model->getAllDataForTechnician($orderId);
        return $this->respond($transaction, 200);
    }
}
