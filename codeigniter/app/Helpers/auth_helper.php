<?php

use App\Models\CustomerModel;
use App\Models\SellerModel;

function createSession($user, $userType) {

    $roleId = '';
    if ($userType == 'Seller') {
        $roleId = (new SellerModel())->getWhere(['user' => $user['user_id']])->getFirstRow('array')['seller_id'];
    } else if ($userType == 'Customer') {
        $roleId = (new CustomerModel())->getWhere(['user' => $user['user_id']])->getFirstRow('array')['customer_id'];   
    }
    $data = [
        'userId' => $user['user_id'],
        'loggedIn' => true,
        'userType' => $userType,
        'roleId' => $roleId
    ];
    session()->set($data);
}