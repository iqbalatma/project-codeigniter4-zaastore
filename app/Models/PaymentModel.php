<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table      = 'payment';
    protected $primaryKey = 'id_payment';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_paymen', 'payment_code',  'paid_amount', 'date_payment', 'id_order', 'payment_left', 'is_deleted', 'image_payment'];

    public function last_row()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->limit(1);
        $builder->orderBy("id_payment", "DESC");
        $builder->where("is_deleted", 0);
        $result = $builder->get()->getResultArray();
        return $result;
    }

    public function update_payment($id_order)
    {
        $builder = $this->db->table($this->table);
        $builder->set('is_deleted', 1);
        $builder->where('id_order', $id_order);
        $builder->update();
    }
}
