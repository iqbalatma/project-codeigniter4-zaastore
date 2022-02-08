<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order_list';
    protected $primaryKey = 'id_order';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_order', 'order_code',  'design_notes', 'size_acrilic', 'font', 'cable_length', 'adaptor', 'waterproof', 'controller', 'adhesive', 'switch', 'laser_cut', 'price', 'address', 'notes', 'is_deleted', 'image', 'order_date', 'faktur_code', 'deadline', 'id_user', 'id_status', 'id_technician', 'checkout_image', 'image_product', 'peniklan', 'total_price', 'extra_price', 'installation_price', 'installation_status', 'installation_image', 'id_installer', 'date_production_done', 'source_order', 'date_installation_done', 'date_paid_off',];


    public function last_row()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->limit(1);
        $builder->orderBy("id_order", "DESC");
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function getAllDataForDashboard()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy("deadline", "asc");
        $builder->where('order_list.id_status = 1 OR order_list.id_status = 5', NULL);
        // $builder->where('order_list.id_status = 5', NULL);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getAllData()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->where('order_list.is_deleted', 0);
        $builder->orderBy("deadline", "asc");
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getAllDataByMonth($month = "", $year = "")
    {
        if ($month == "" && $year == "") {
            date_default_timezone_set('Asia/Jakarta');
            $year = date('Y', time());
            $month = date('m', time());
        }
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy("deadline", "asc");
        $builder->where('MONTH(order_list.order_date)', $month);
        $builder->where('YEAR(order_list.order_date)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }



    public function getAllDataDesignOnly()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.image_product IS NULL', NULL);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 1])->getResultArray();
        return $query;
    }



    public function getAllDataCheckout()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 4])->getResultArray();
        return $query;
    }

    //checkout data's this month (now)
    public function getAllDataCheckoutByMonth($month = "", $year = "")
    {
        if ($month == "" && $year == "") {
            date_default_timezone_set('Asia/Jakarta');
            $year = date('Y', time());
            $month = date('m', time());
        }

        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('MONTH(order_list.deadline)', $month);
        $builder->where('YEAR(order_list.deadline)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 4])->getResultArray();
        return $query;
    }
















    // data order untuk semua teknisi yang sudah selesai
    public function getAllDataOrderForTechnicianDoneAssignment()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }
    // data order untuk semua teknisi yang sudah selesai
    public function getAllDataOrderForTechnicianDoneAssignmentByMonth($month, $year)
    {
        if ($month == "" && $year == "") {
            date_default_timezone_set('Asia/Jakarta');
            $year = date('Y', time());
            $month = date('m', time());
        }

        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
        $builder->where('MONTH(order_list.deadline)', $month);
        $builder->where('YEAR(order_list.deadline)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }












    public function getDataOrderForInstallerDoneThisMonth($id_installer, $month, $year)
    {
        if ($month == "" && $year == "") {
            date_default_timezone_set('Asia/Jakarta');
            $year = date('Y', time());
            $month = date('m', time());
        }
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('order_list.date_installation_done', 'ASC');
        $builder->where('order_list.id_installer', $id_installer); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
        $builder->where('MONTH(order_list.date_installation_done)', $month);
        $builder->where('YEAR(order_list.date_installation_done)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getAllDataOrderForTechnicianOnProgress()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
        $builder->where('order_list.id_status = 1', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getAllDataOrderForInstallerOnProgress()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_installer is NOT NULL', NULL, FALSE);
        $builder->where('order_list.installation_price > 0', NULL, FALSE);
        $builder->where('order_list.installation_status = 0', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }























    // BACKUP
    // public function getAllDataAssignment()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('id_technician', null);
    //     $builder->where('order_list.id_status', 1);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }


    // public function getAllDataAssignmentInstallation()
    // {
    //     //untuk penugasan installasi
    //     //digunakan pada controller Assignment
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('id_installer', null);
    //     // $builder->where('order_list.id_status', 1);
    //     $builder->where('order_list.installation_price != ""', NULL);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    public function getAllDataWaitingList()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 5])->getResultArray();
        return $query;
    }

    // public function getAllDataDesign()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.image_product IS NOT NULL', NULL);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->getWhere(["order_list.id_status" => 1])->getResultArray();
    //     return $query;
    // }

    public function getAllDataProduction()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 2])->getResultArray();
        return $query;
    }

    public function getAllDataPacking()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 3])->getResultArray();
        return $query;
    }

    // public function getAllDataInstallation()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.installation_status = 0', NULL, FALSE);
    //     $builder->where('order_list.installation_image IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.id_installer IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.installation_price > 0', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // public function getAllDataPaidOffByMonth($month = "", $year = "")
    // {
    //     if (
    //         $month == "" && $year == ""
    //     ) {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $year = date('Y', time());
    //         $month = date('m', time());
    //     }
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy("date_paid_off", "asc");
    //     $builder->where('MONTH(order_list.date_paid_off)', $month);
    //     $builder->where(
    //         'YEAR(order_list.date_paid_off)',
    //         $year
    //     );
    //     $builder->where('order_list.date_paid_off IS NOT NULL', NULL);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // public function getAllDataPaymentPaidOff()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy("date_paid_off", "asc");
    //     $builder->where('order_list.date_paid_off IS NOT NULL', NULL);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // public function getDataOrderForTechnicianDoneThisMonth($id_technician, $month, $year)
    // {
    //     if (
    //         $month == "" && $year == ""
    //     ) {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $year = date('Y', time());
    //         $month = date('m', time());
    //     }
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join(
    //         'status',
    //         $this->table . '.id_status = status.id_status'
    //     );
    //     $builder->orderBy('order_list.date_production_done', 'ASC');
    //     $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.id_status != 1', NULL, FALSE);
    //     $builder->where('MONTH(order_list.date_production_done)', $month);
    //     $builder->where('YEAR(order_list.date_production_done)', $year);
    //     $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk masing-masing teknisi yang sudah selesai
    //DONE
    // public function getDataOrderForTechnicianDone($id_technician)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('order_list.date_production_done', 'ASC');
    //     $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.id_status != 1', NULL, FALSE);
    //     $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }
    // data order untuk masing-masing teknisi yang menunggu konfirmasi
    //WAITING CONFIRM
    // public function getDataOrderForTechnicianWaitingConfirm($id_technician)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.id_status = 1', NULL, FALSE);
    //     $builder->where('order_list.image_product IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk masing-masing teknisi
    //ON PROGRESS
    // public function getDataOrderForTechnician($id_technician)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.id_status', 1);
    //     $builder->where('order_list.image_product IS NULL', null, false);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk semua teknisi yang masih dalam progress



    // data order untuk semua teknisi yang sudah selesai
    // public function getAllDataOrderForTechnicianDoneThisMonth($month, $year)
    // {
    //     if ($month == "" && $year == "") {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $year = date('Y', time());
    //         $month = date('m', time());
    //     }
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.id_status != 1', NULL, FALSE);
    //     $builder->where('MONTH(order_list.date_production_done)', $month);
    //     $builder->where('YEAR(order_list.date_production_done)', $year);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk semua teknisi yang sudah selesai
    // public function getAllDataOrderForTechnicianDone()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.id_status != 1', NULL, FALSE);
    //     $builder->where('order_list.id_status != 5', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // public function getDataOrderForInstallationDoneThisMonth($id_technician, $month, $year)
    // {
    //     if (
    //         $month == "" && $year == ""
    //     ) {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $year = date('Y', time());
    //         $month = date('m', time());
    //     }
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('date_installation_done', 'ASC');
    //     $builder->where('order_list.id_installer', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.installation_status = 1', NULL, FALSE);
    //     $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
    //     $builder->where('MONTH(order_list.date_installation_done)', $month);
    //     $builder->where('YEAR(order_list.date_installation_done)', $year);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk masing-masing teknisi yang sudah selesai
    //DONE
    // public function getDataOrderForInstallationDone($id_technician)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('date_installation_done', 'ASC');
    //     $builder->where('order_list.id_installer', $id_technician); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.installation_status = 1', NULL, FALSE);
    //     $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // public function getDataOrderForInstallation($id_installer)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_installer', $id_installer);
    //     $builder->where('order_list.installation_image IS NULL', null, false);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }

    // data order untuk masing-masing teknisi yang menunggu konfirmasi
    //WAITING CONFIRM
    // public function getDataOrderForInstallationWaitingConfirm($id_technician)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_installer', $id_technician);
    //     $builder->where('order_list.installation_image IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.installation_status = 0', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }


    // public function getDataOrderForInstallerDone($id_installer)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('order_list.date_installation_done', 'ASC');
    //     $builder->where('order_list.id_installer', $id_installer); //hardcode harusnya id teknisi dari sesi
    //     $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }




    // data order untuk semua installer yang masih dalam progress
    // public function getAllDataOrderForInstallerOnProgress()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.id_installer is NOT NULL', NULL, FALSE);
    //     $builder->where('order_list.installation_price > 0', NULL, FALSE);
    //     $builder->where('order_list.installation_status = 0', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }



    // data order untuk semua teknisi yang sudah selesai
    // public function getAllDataOrderForInstallerDone()
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.date_installation_done is NOT NULL', NULL, FALSE);
    //     // $builder->where('order_list.installation_image is NOT NULL', NULL, FALSE);
    //     // $builder->where('order_list.installation_price > 0', NULL, FALSE);
    //     $builder->where('order_list.installation_status > 0', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }



    // data order untuk semua teknisi yang sudah selesai
    // public function getAllDataOrderForInstallerDoneThisMonth($month, $year)
    // {
    //     if ($month == "" && $year == "") {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $year = date('Y', time());
    //         $month = date('m', time());
    //     }
    //     $builder = $this->db->table($this->table);
    //     $builder->select('order_list.*, users.fullname, status.status_name');
    //     $builder->join('users', $this->table . '.id_user = users.id_user');
    //     $builder->join('status', $this->table . '.id_status = status.id_status');
    //     $builder->orderBy('deadline', 'ASC');
    //     $builder->where('order_list.date_installation_done is NOT NULL', NULL, FALSE);
    //     // $builder->where('order_list.installation_image is NOT NULL', NULL, FALSE);
    //     // $builder->where('order_list.installation_price > 0', NULL, FALSE);
    //     $builder->where('MONTH(order_list.date_installation_done)', $month);
    //     $builder->where('YEAR(order_list.date_installation_done)', $year);
    //     $builder->where('order_list.installation_status > 0', NULL, FALSE);
    //     $builder->where('order_list.is_deleted', 0);
    //     $query = $builder->get()->getResultArray();
    //     return $query;
    // }
}
