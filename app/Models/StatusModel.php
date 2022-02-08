<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table      = 'order_list';
    protected $primaryKey = 'id_order';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_order', 'order_code',  'design_notes', 'size_acrilic', 'font', 'cable_length', 'adaptor', 'waterproof', 'controller', 'adhesive', 'switch', 'laser_cut', 'price', 'address', 'notes', 'is_deleted', 'image', 'order_date', 'faktur_code', 'deadline', 'id_user', 'id_status', 'id_technician', 'checkout_image', 'technician_payment', 'image_product', 'peniklan', 'total_price', 'extra_price', 'installation_price', 'installation_status', 'installation_image', 'id_installer', 'date_production_done', 'source_order', 'date_installation_done', 'date_paid_off'];



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


    public function getAllDataDesign()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.image_product IS NOT NULL', NULL);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->getWhere(["order_list.id_status" => 1])->getResultArray();
        return $query;
    }


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

    public function getAllDataInstallation()
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_list.*, users.fullname, status.status_name');
        $builder->join('users', $this->table . '.id_user = users.id_user');
        $builder->join('status', $this->table . '.id_status = status.id_status');
        $builder->orderBy('deadline', 'ASC');
        $builder->where('order_list.installation_status = 0', NULL, FALSE);
        $builder->where('order_list.installation_image IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.id_installer IS NOT NULL', NULL, FALSE);
        $builder->where('order_list.installation_price > 0', NULL, FALSE);
        $builder->where('order_list.is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
