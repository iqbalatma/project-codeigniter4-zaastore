<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseTransactionModel extends Model
{
    protected $table      = 'warehouse_transaction';
    protected $primaryKey = 'id_transaction';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['id_transaction', 'id_bahan_baku', 'jenis_transaksi', 'quantity', 'date', 'id_user', 'id_order'];



    public function getAllData()
    {
        $builder = $this->db->table($this->table);
        $builder->select('warehouse_transaction.*, bahan_baku.fullname, unit.nama_unit');
        $builder->join('bahan_baku', $this->table . '.id_bahan_baku = bahan_baku.id_bahan_baku');
        $builder->join('unit', 'bahan_baku.id_unit = unit.id_unit');
        $builder->orderBy("date", "desc");
        $query = $builder->get()->getResultArray();
        return $query;
    }
    public function getAllDataForTechnician($id_order)
    {
        $builder = $this->db->table($this->table);
        $builder->select('warehouse_transaction.*, bahan_baku.fullname, unit.nama_unit');
        $builder->join('bahan_baku', $this->table . '.id_bahan_baku = bahan_baku.id_bahan_baku');
        $builder->join('unit', 'bahan_baku.id_unit = unit.id_unit');
        $builder->where('warehouse_transaction.id_order', $id_order);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
