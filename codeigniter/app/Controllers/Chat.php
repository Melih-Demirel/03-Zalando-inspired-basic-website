<?php

namespace App\Controllers;

use App\Models\ChatModel;
use App\Models\ChatMSGModel;

class Chat extends BaseController
{    
    public function index()
    {    
        $session = session();
        $chats = [];
        $chatM = new ChatModel();    
        $isCustomer = ($session->get('userType') == 'Customer');

        if ($isCustomer) $chats = $chatM->getChatsOfCustomer($session->get('roleId'));
        else if (!$isCustomer)
            $chats = $chatM->getChatsOfSeller($session->get('roleId'));
        return view('chat/chat.php', ['chat' => [], 'chats' => $chats, 'chat_id' => NULL, 'customer' => $isCustomer]);
    }

        
    public function chat($personChatting) {
        $session = session();
        $chatM = new ChatModel();
        $chatData = [];
        $chats = [];
        $chatId = null;
        $isCustomer = ($session->get('userType') == 'Customer');
        
        if ($isCustomer) {
            if ($personChatting != "NULL") {
                $chatData = (new ChatMSGModel())->getMessages($session->get('roleId'), $personChatting);
                $chatId = $chatM->getWhere(['customer' => $session->get('roleId'), 'seller' => $personChatting])->getFirstRow()->chat_id;
            } 
            $chats = $chatM->getChatsOfCustomer($session->get('roleId'));
        } else if (!$isCustomer) {
            if ($personChatting != "NULL") {
                $chatData = (new ChatMSGModel())->getMessages($personChatting, $session->get('roleId'));
                $chatId = $chatM->getWhere(['seller' => $session->get('roleId'), 'customer' => $personChatting])->getFirstRow()->chat_id;
            }
            $chats = $chatM->getChatsOfSeller($session->get('roleId'));
        }
        return view('chat/chat.php', ['chat' => $chatData, 'chats' => $chats, 'chat_id' => $chatId, 'customer' => $isCustomer, 'chatting_to' => $personChatting]);
    }
    
    public function getChatMessages() {
        helper(['ajax']);
        $data = ['chat' => esc($this->request->getJsonVar('chat'))];
        $chatMessages = (new ChatMSGModel())->getChatMessages($data);
        echo createAjaxResponse($chatMessages);    
    }

    public function addChatMessage() {
        helper(['ajax']);
        $chatMsgM = new ChatMSGModel();
        $userMSG = 1;
        if (session()->get('userType') == 'Seller')
            $userMSG = 0;
        $data = ['msg' => esc($this->request->getVar('msg')), 'chat' => esc($this->request->getVar('chat')), 'userMSG' => $userMSG];
        $response = $chatMsgM->addMessage($data);
        echo createAjaxResponse($response);
    }
}