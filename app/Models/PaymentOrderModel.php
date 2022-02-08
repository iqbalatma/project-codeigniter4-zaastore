<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentOrderModel extends Model
{
    protected $table      = 'order_list';
    protected $primaryKey = 'id_order';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_order', 'order_code',  'design_notes', 'size_acrilic', 'font', 'cable_length', 'adaptor', 'waterproof', 'controller', 'adhesive', 'switch', 'laser_cut', 'price', 'address', 'notes', 'is_deleted', 'image', 'order_date', 'faktur_code', 'deadline', 'id_user', 'id_status', 'id_technician', 'checkout_image', 'technician_payment', 'image_product', 'peniklan', 'total_price', 'extra_price', 'installation_price', 'installation_status', 'installation_image', 'id_installer', 'date_production_done', 'source_order', 'date_installation_done', 'date_paid_off'];


    /**
     * Untuk semua data lunas
     * Ajax : view_payment.php
     * Controller : PaymentAPI.php
     */
    public function getAllDataPaidOff($month = "", $year = "", $isAll = true)
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
        $builder->orderBy("date_paid_off", "asc");
        if ($isAll == false) {
            $builder->where('MONTH(order_list.date_paid_off)', $month);
            $builder->where(
                'YEAR(order_list.date_paid_off)',
                $year
            );
        }
        $builder->where('order_list.date_paid_off IS NOT NULL', NULL);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    /**
     * !PERSIAPAN UNTUK DIGANTI
     */
    public function getAllDataPaidOffByMonth($month = "", $year = "")
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
        $builder->orderBy("date_paid_off", "asc");
        $builder->where('MONTH(order_list.date_paid_off)', $month);
        $builder->where(
            'YEAR(order_list.date_paid_off)',
            $year
        );
        $builder->where('order_list.date_paid_off IS NOT NULL', NULL);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    /**
     * !PERSIAPAN UNTUK DIGANTI
     */
    public function getAllDataPaymentPaidOff()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy("date_paid_off", "asc");
        $builder->where('order_list.date_paid_off IS NOT NULL', NULL);
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
}
