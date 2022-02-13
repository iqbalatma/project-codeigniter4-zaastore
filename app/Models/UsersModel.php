<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['id_user', 'fullname', 'username', 'password', 'phonenumber', 'id_role', 'is_deleted'];




    public function getNameById($id_user)
    {
        $builder = $this->db->table($this->table);
        $builder->select('fullname');
        $builder->where('id_user', $id_user);
        $builder->where('is_deleted', 0);
        $query = $builder->get()->getResultArray();
        return $query;
    }


    public function getDataAccount()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('role', 'users.id_role = role.id_role');
        $builder->orderBy('is_deleted', 'asc');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
