<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model
{
    protected $table      = 'bahan_baku';
    protected $primaryKey = 'id_bahan_baku';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_bahan_baku', 'fullname', 'id_unit', 'quantity', 'update_at', 'is_deleted', 'threshold'];




    public function getAllData()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('unit', $this->table . '.id_unit = unit.id_unit');
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function updateQuantity($data)
    {

        $quantity = intval($data["quantity"]);
        $id = intval($data["id"]);
        $jenis_transaksi = $data["jenis_transaksi"];
        $update_at = $data["update_at"];
        if ($jenis_transaksi == "keluar") {
            return $query = $this->db->query("UPDATE bahan_baku SET quantity = quantity - $quantity, update_at = '$update_at'  WHERE id_bahan_baku = $id");
        } else {
            return $query = $this->db->query("UPDATE bahan_baku SET quantity = quantity + $quantity, update_at = '$update_at' WHERE id_bahan_baku = $id");
        }
    }

    public function edit_quantity($id_bahan_baku, $selisih, $update_at)
    {
        return $query = $this->db->query("UPDATE bahan_baku SET quantity = quantity + $selisih, update_at = '$update_at' WHERE id_bahan_baku = $id_bahan_baku");
    }

    public function getAllDataKritis()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('unit', $this->table . '.id_unit = unit.id_unit');
        $builder->where('bahan_baku.quantity <= bahan_baku.threshold', NULL);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
