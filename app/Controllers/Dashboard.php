<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::check_login();
    }

    public function index()
    {

        $id_role = $_SESSION["role"];
        if ($id_role == 4) {
            return redirect()->to("/technician");
        } elseif ($id_role == 3) {
            return redirect()->to("/add-order");
        } elseif ($id_role == 6) {
            return redirect()->to("/payment/done-this-month");
        } elseif ($id_role == 7) {
            return redirect()->to("status-design");
        }



        if ($id_role == 3  || $id_role == 4) {
            return redirect()->to("HttpRequest");
        }



        $data = [
            "title" => "Dashboard",
            "content" =>  "view_dashboard",
            // "order_data" => $order_data,
            "order_data_on_progress" => $this->order_model->getAllData(),
            "unit" => $this->unit->findAll(),
            "session" => $this->session->get(),


            "payment" => $this->payment_model,
            "session" => $this->session->get(),
            "technician" => $this->order_model->getAllDataOrderForTechnicianOnProgress(),
            "user_technician" => $this->users_model,


            "session" => $this->session->get(),
            "installer" => $this->order_model->getAllDataOrderForInstallerOnProgress(),
            "user_technician" => $this->users_model,

            "request_bahan" => $this->order_model->getAllDataForDashboard(),
            "warehouse" => $this->warehouse->getAllData(),
            "warehouse_kritis" => $this->warehouse->getAllDataKritis()

        ];
        return view('view_dashboard/view_dashboard', $data);
    }
}
