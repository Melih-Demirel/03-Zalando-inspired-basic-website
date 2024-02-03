<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatMSGModel extends Model
{
    protected $primaryKey = 'msg_id';
    protected $table = 'chatMSG';
    protected $allowedFields = ['chat', 'msg', 'sent_at', 'userMSG'];
    
    protected function initialize()
    {
        helper(['response']);
    }

    public function getMessages($customer, $seller) {
        $chatM = new ChatModel();
        if ($chatM->getWhere(['customer' => $customer, 'seller' => $seller])->getNumRows() == 0) {
            $chatM->openNewChat($customer, $seller);
            return [];
        }
        else{
            $chatId = $chatM->getWhere(['customer' => $customer, 'seller' => $seller])->getFirstRow()->chat_id;
            return db_connect()->table('ChatMSGView')->getWhere(['chat' => $chatId])->getResultArray();
        }
    }

    public function addMessage($data) {
        if ((new ChatModel())->getWhere(['chat_id' => $data['chat']])->getNumRows() == 0)
            return createResponse(false, "Chat id does not exist.");
        if (!$this->insert($data))
            return createResponse(false, "Failed to send message!");
        return createResponse(false, 'Successfully sent a message!');
    }
    
    
}