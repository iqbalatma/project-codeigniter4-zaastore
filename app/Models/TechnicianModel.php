<?php

namespace App\Models;

use CodeIgniter\Model;

class TechnicianModel extends Model
{
    protected $table      = 'order_list';
    protected $primaryKey = 'id_order';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_order', 'order_code',  'design_notes', 'size_acrilic', 'font', 'cable_length', 'adaptor', 'waterproof', 'controller', 'adhesive', 'switch', 'laser_cut', 'price', 'address', 'notes', 'is_deleted', 'image', 'order_date', 'faktur_code', 'deadline', 'id_user', 'id_status', 'id_technician', 'checkout_image', 'technician_payment', 'image_product', 'peniklan', 'total_price', 'extra_price', 'installation_price', 'installation_status', 'installation_image', 'id_installer', 'date_production_done', 'source_order', 'date_installation_done', 'date_paid_off'];


    public function getAllDataOrder(
        $type = "on-progress",
        $month = "",
        $year = ""
    ) {
        if ($month == "" && $year == "") {
            date_default_timezone_set('Asia/Jakarta');
            $year = getYearNow();
            $month = getMonthNow();
        }
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);

        if ($type == "on-progress") {
            $builder->where('order_list.id_status = 1', NULL, FALSE);
        } elseif ($type == "all") {
            $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
            $builder->where('order_list.id_status != 1', NULL, FALSE);
            $builder->where('order_list.id_status != 5', NULL, FALSE);
        } elseif ($type == "monthly") {
            $builder->where('order_list.id_status != 1', NULL, FALSE);
            $builder->where('MONTH(order_list.date_production_done)', $month);
            $builder->where('YEAR(order_list.date_production_done)', $year);
        }

        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getDataOrderForTechnicianDoneThisMonth($id_technician, $month, $year)
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
        $builder->join(
            'status',
            $this->table . '.id_status = status.id_status'
        );
        $builder->orderBy('order_list.date_production_done', 'ASC');
        $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.id_status != 1', NULL, FALSE);
        $builder->where('MONTH(order_list.date_production_done)', $month);
        $builder->where('YEAR(order_list.date_production_done)', $year);
        $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataOrderForTechnicianDone($id_technician)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('order_list.date_production_done', 'ASC');
        $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.id_status != 1', NULL, FALSE);
        $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataOrderForTechnicianWaitingConfirm($id_technician)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.id_status = 1', NULL, FALSE);
        $builder->where('order_list.image_product IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataOrderForTechnician($id_technician)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician', $id_technician); //hardcode harusnya id teknisi dari sesi
        $builder->where('order_list.id_status', 1);
        $builder->where('order_list.image_product IS NULL', null, false);
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

    public function getAllDataOrderForTechnicianDoneThisMonth($month, $year)
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
        $builder->where('order_list.id_status != 1', NULL, FALSE);
        $builder->where('MONTH(order_list.date_production_done)', $month);
        $builder->where('YEAR(order_list.date_production_done)', $year);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getAllDataOrderForTechnicianDone()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.id_technician is NOT NULL', NULL, FALSE);
        $builder->where('order_list.date_production_done is NOT NULL', NULL, FALSE);
        $builder->where('order_list.id_status != 1', NULL, FALSE);
        $builder->where('order_list.id_status != 5', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
