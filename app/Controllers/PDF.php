<?php

namespace App\Controllers;

use TCPDF;

class PDF extends BaseController
{
    public function __construct()
    {
        parent::check_login();
    }


    public function tes()
    {
        return view("view_pdf");
    }

    public function print_pdf()
    {

        $title = $this->request->getGet("title");
        $view = $this->request->getGet("view");
        $nama_teknisi = $this->request->getGet("nama_teknisi");
        $data_type = $this->request->getGet("data_type");
        $month = $this->request->getGet("month");
        $year = $this->request->getGet("year");

        // untuk payment lunas
        if ($data_type == "payment_all") {
            $order_data = $this->order_model->getAllDataPaymentPaidOff();
        } else {
            $order_data = $this->order_model->getAllDataPaidOffByMonth($month, $year);
        }

        if ($data_type == "done_all") {
            $technician = $this->order_model->getAllDataOrderForTechnicianDone();
            $installer = $this->order_model->getAllDataOrderForInstallerDone();
            $technician_done = $this->order_model->getDataOrderForTechnicianDone($this->session->get("id_user"));
            $installation_done =
                $this->order_model->getDataOrderForInstallationDone($this->session->get("id_user"));
        } else {
            $technician = $this->order_model->getAllDataOrderForTechnicianDoneThisMonth($month, $year);
            $installer = $this->order_model->getAllDataOrderForInstallerDoneThisMonth($month, $year);
            $technician_done = $this->order_model->getDataOrderForTechnicianDoneThisMonth($this->session->get("id_user"), $month, $year);
            $installation_done =
                $this->order_model->getDataOrderForInstallationDoneThisMonth($this->session->get("id_user"), $month, $year);
        }



        $flashdata = null;
        if ($this->session->getFlashdata('msg') !== null) {
            $flashdata = $this->session->getFlashdata('msg');
        }
        $data = [
            "title" => $title,
            "content" => "view_payment",
            "session" => $this->session->get(),
            "payment" => $this->payment_model,
            "data_type" => $data_type,
            "nama_teknisi" => $nama_teknisi,
            "flashdata" => $flashdata,

            "technician" => $technician,
            "user_technician" => $this->users_model,

            "warehouse" => $this->warehouse->getAllData(),
            "technician_done" => $technician_done,
            "installation_done" => $installation_done,

            "order_data" => $order_data,
            "order_data_on_progress" => $this->order_model->getAllData(),
            "unit" => $this->unit->findAll(),

            "installer" => $installer,

            "user_technician_by_id" => $this->users_model->where('id_role', 4)
                ->findAll(),
            "name_technician" => $this->users_model,
            "order_technician" => $this->order_model,

            "month" => $month,
            "year" => $year

        ];

        $html =  view($view, $data);























        $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Zaastore');
        $pdf->SetTitle($title);
        $pdf->SetSubject('tss');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage("L", "A4");

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('pembayaran.pdf', 'I');
    }
}
