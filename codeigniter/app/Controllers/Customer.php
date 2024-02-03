<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\NotificationsModel;

class Customer extends BaseController
{
    var $navbar = [ 
        ['value' => 'Account', 'href' => '/customer/account'], 
        ['value' => 'Orders', 'href' => '/customer/orders'], 
        ['value' => 'Notifications', 'href' => '/customer/notifications'], 
        ['value' => 'Chat', 'href' => '/chat/inbox'], 
        ['value' => 'Sign Out', 'href' => '/auth/signout']];


    public function account() {
        return view('customer/account', ['navbar' => [$this->navbar, 0], 'customer' => (new CustomerModel())->getCustomerData(session()->get('roleId'))]);
    }
    
    public function orders() {
        return view('customer/orders', ['navbar' => [$this->navbar, 1], 'orders' => (new OrderModel())->getOrdersCustomer(session()->get('roleId'))]);
    }
    
    public function notifications() {
        $notiM = new NotificationsModel();
        $notiM->setNotificationsToRead(session()->get('roleId'));
        return view('customer/notifications', ['navbar' => [$this->navbar, 2], 'notifications' => $notiM->getNotificationsOfCustomer(session()->get('roleId'))]);
    }
}
