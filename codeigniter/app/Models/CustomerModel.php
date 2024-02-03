<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $primaryKey = 'customer_id';
    protected $table = 'customer';
    protected $allowedFields = ['user', 'name', 'surname'];
    
    protected function initialize()
    {
    
    }
    
    public function getCustomerData($customer_id) {
        $customerData = $this->getWhere(['customer_id' => $customer_id])->getFirstRow('array');
        $customerData['email'] = (new UserModel())->getWhere(['user_id' => $customerData['user']])->getFirstRow()->email;
        return $customerData;
    }

}