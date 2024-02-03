<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $primaryKey = 'img_id';
    protected $table = 'productimage';
    protected $allowedFields = ['img', 'product'];
}