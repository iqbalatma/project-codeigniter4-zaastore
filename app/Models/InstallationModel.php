<?php

namespace App\Models;

use CodeIgniter\Model;

class InstallationModel extends Model
{
    protected $table      = 'order_list';
    protected $primaryKey = 'id_order';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_order', 'order_code',  'design_notes', 'size_acrilic', 'font', 'cable_length', 'adaptor', 'waterproof', 'controller', 'adhesive', 'switch', 'laser_cut', 'price', 'address', 'notes', 'is_deleted', 'image', 'order_date', 'faktur_code', 'deadline', 'id_user', 'id_status', 'id_technician', 'checkout_image', 'technician_payment', 'image_product', 'peniklan', 'total_price', 'extra_price', 'installation_price', 'installation_status', 'installation_image', 'id_installer', 'date_production_done', 'source_order', 'date_installation_done', 'date_paid_off'];


    public function getAllDataOrder($type = "on-progress", $month = "", $year = "")
    {
        if ($month == "" && $year == "") {
            $year = getYearNow();
            $month = getMonthNow();
        }
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_installer is NOT NULL', NULL, FALSE);
        $builder->where('order_list.installation_price > 0', NULL, FALSE);
        $builder->where('order_list.installation_status = 0', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        if ($type == "all") {
            $builder->where('order_list.date_installation_done is NOT NULL', NULL, FALSE);
            $builder->where('order_list.installation_status > 0', NULL, FALSE);
        } elseif ($type == "monthly") {
            $builder->where('order_list.date_installation_done is NOT NULL', NULL, FALSE);
            $builder->where('order_list.installation_status > 0', NULL, FALSE);
            $builder->where('MONTH(order_list.date_installation_done)', $month);
            $builder->where('YEAR(order_list.date_installation_done)', $year);
        }
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getDataOrderForInstallationDoneThisMonth($id_technician, $month, $year)
    {
        if (
            $month == "" && $year == ""
        ) {
            date_default_timezone_set('Asia/Jakarta');
            $year = date('Y', time());
            $month = date('m', time());
        }
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('date_installation_done', 'ASC');
        $builder->where('order_list.id_installer', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.installation_status = 1', NULL, FALSE);
        $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
        $builder->where('MONTH(order_list.date_installation_done)', $month);
        $builder->where('YEAR(order_list.date_installation_done)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataOrderForInstallationDone($id_technician)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('date_installation_done', 'ASC');
        $builder->where('order_list.id_installer', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.installation_status = 1', NULL, FALSE);
        $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getDataOrderForInstallation($id_installer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_installer', $id_installer);
        $builder->where('order_list.installation_image IS NULL', null, false);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataOrderForInstallationWaitingConfirm($id_technician)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_installer', $id_technician);
        $builder->where('order_list.installation_image IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.installation_status = 0', NULL, FALSE);
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

    public function getDataOrderForInstallerDone($id_installer)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('order_list.date_installation_done', 'ASC');
        $builder->where('order_list.id_installer', $id_installer); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.date_installation_done IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getAllDataOrderForInstallerDoneThisMonth($month, $year)
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
        $builder->where('order_list.date_installation_done is NOT NULL', NULL, FALSE);
        // $builder->where('order_list.installation_image is NOT NULL', NULL, FALSE);
        // $builder->where('order_list.installation_price > 0', NULL, FALSE);
        $builder->where('MONTH(order_list.date_installation_done)', $month);
        $builder->where('YEAR(order_list.date_installation_done)', $year);
        $builder->where('order_list.installation_status > 0', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
