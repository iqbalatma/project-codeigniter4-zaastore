<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageDesignModel extends Model
{
    protected $table      = 'image_design';
    protected $primaryKey = 'id_image_design';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_image_design', 'image_name', 'created_at', 'update_at', 'is_deleted', 'id_order'];
}
