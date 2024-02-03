<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $primaryKey = 'chat_id';
    protected $table = 'chat';
    protected $allowedFields = ['seller', 'customer'];
    
    protected function initialize()
    {

    }
        
    public function getChatsOfCustomer($customer) {
        return db_connect()->table('ChatView')->getWhere(['customer_id' => $customer])->getResultArray();
    }

    public function getChatsOfSeller($sellerID) {    
        return db_connect()->table('ChatView')->getWhere(['seller_id' => $sellerID])->getResultArray();
    }
    
    public function openNewChat($customer, $seller) {
        if (!($this->getWhere(['customer' => $customer, 'seller' => $seller])->getNumRows() > 0))
            $this->insert(['customer' => $customer, 'seller' => $seller]);
    } 
}