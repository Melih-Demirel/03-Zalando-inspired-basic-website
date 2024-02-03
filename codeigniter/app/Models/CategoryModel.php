<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $primaryKey = 'category_id';
    protected $table = 'category';
    protected $allowedFields = ['name'];
}