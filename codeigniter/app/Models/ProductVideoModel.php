<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductVideoModel extends Model
{
    protected $primaryKey = 'video_id';
    protected $table = 'productvideo';
    protected $allowedFields = ['video_url', 'product'];
}