<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\CartModel;

class Order extends BaseController
{
    
    public function index()
    {
        $cartItems = (new CartModel())->getCartOfCustomer(session()->get('roleId'));
        if(empty($cartItems)){
            return redirect()->to(base_url() . '/cart');
        }
        return view('order/address');
    }
    
    public function success() {
        $orderM = new OrderModel();
        $data = ['order_type' => esc($this->request->getVar('type')), 'customer' => session()->get('roleId')];
        if ($data['order_type'] == 'Pick Up') {
            $data['delivery_date'] = esc($this->request->getVar('delivery_date')); 
            $orderM->createNewOrder($data);
        } else if ($data['order_type'] == 'Delivery') {
            $data['street'] = esc($this->request->getVar('address'));
            $data['zipcode'] = esc($this->request->getVar('zipcode'));
            $data['town'] = esc($this->request->getVar('town'));
            $orderM->createNewOrder($data);
        }
        return view('order/success');
    }
    
    public function cancel() {
        helper(['ajax']);
        $response = (new OrderItemModel())->cancelOrderItem(esc($this->request->getVar('orderItem')));
        if ($response['success'] == FALSE)
            $response['message'] = "Failed to cancel order.";
        else
            $response['message'] = "Successfully cancelled order.";
        echo createAjaxResponse($response);
    }

    public function complete() {
        helper(['ajax']);
        echo createAjaxResponse((new OrderItemModel())->completeOrderItem(esc($this->request->getVar('orderItem'))));
    }
}