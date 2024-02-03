<?php

namespace App\Models;

use CodeIgniter\Model;
class NotifyProductModel extends Model
{
    protected $table = 'notifyproduct';
    protected $primaryKey = 'notify_id';
    protected $allowedFields = ['product', 'customer'];
    
    protected function initialize()
    {

    }
    
    public function addCustomerToProductNotification($customerId, $productId) {
        if (!$this->getWhere(['product' => $productId, 'customer' => $customerId])->getFirstRow())
            $this->insert(['product' => $productId, 'customer' => $customerId])
    }

}