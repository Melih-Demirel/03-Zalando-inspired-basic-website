<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class OrderModel extends Model
{
    protected $primaryKey = 'order_id';
    protected $table = 'order';
    protected $allowedFields = ['customer', 'order_date', 'order_type', 'street', 'zipcode', 'town'];

    
    protected function initialize()
    {
    
    }
    
    public function getOrdersSeller($seller) {
        return db_connect()->table('sellerOrderView')->getWhere(['seller_id' => $seller])->getResultArray();
    }

    public function getOrdersCustomer($customerId) {
        $customerOrders = $this->getWhere(['customer' => $customerId])->getResultArray();        
        $ordersCustomer = [];
        foreach ($customerOrders as $order) {
            $orderItems = db_connect()->table('orderview')->getWhere(['Order' => $order['order_id']])->getResultArray();
            $totalPrice = 0.00;
            for ($i=0; $i < count($orderItems); $i++) { 
                $orderItems[$i]['images'] = (new ProductModel())->getImagesOfProduct($orderItems[$i]['product']);
                $totalPrice += floatval($orderItems[$i]['price']) * intval($orderItems[$i]['amount']);
            }
            array_push($ordersCustomer, ['order' =>$order['order_id'] ,'totalPrice' => $totalPrice, 'items' => $orderItems, 'order_date' => $order['order_date'], 'type' => $order['order_type']]);
        }
        return $ordersCustomer;
    }

    public function createNewOrder($data) {
        $orderId = $this->insert($data);
        $cartItems = (new CartModel())->getWhere(['customer' => $data['customer']])->getResultArray();
        $data['order_date'] = (new Time(""))->toDateTimeString();
        foreach($cartItems as $cartItem) {
            $orderData = ['Order' => $orderId, 'product' => $cartItem['product'], 'amount' => $cartItem['amount'], 'delivery_date' => 'qzdq'];
            $prod = (new ProductInventoryModel())->getWhere(['product_inventory_id' => $cartItem['product']])->getFirstRow()->product;
            (new OrderItemModel())->insert($orderData);
            (new NotificationsModel())->insert(['product' => $prod, 'customer' =>intval($data['customer']), 'text' => 'Write  Review: ' . (new ProductModel())->getWhere(['product_id' => $prod])->getFirstRow()->name]);
        }
        (new CartModel())->clearCartOfCustomer($data['customer']);
    }
}