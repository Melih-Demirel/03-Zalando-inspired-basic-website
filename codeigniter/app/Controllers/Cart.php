<?php

namespace App\Controllers;

use App\Models\NotificationsModel;
use App\Models\ProductInventoryModel;
use App\Models\ProductModel;
use App\Models\CartModel;

class Cart extends BaseController
{    
    
    public function index()
    {   
        $cartItems = (new CartModel())->getCartOfCustomer(session()->get('roleId'));
        $totalPrice = 0.00;
        foreach ($cartItems as $item)
            $totalPrice += intval($item['amount']) * floatval($item['price']) ;
        return view('customer/cart.php', ['items' => $cartItems, 'totalPrice' => $totalPrice]);
    
    }
    
    public function add() {
        helper(['ajax']);
        $customerId = session()->get('roleId');
        $response = (new CartModel())->addProductToCart($customerId, esc($this->request->getVar('product')));
        echo createAjaxResponse($response);
    }
    
    public function remove() {
        helper(['ajax']);
        $cartModel = new CartModel();
        $cartItemID = $this->request->getVar('cartItem');
        $response = createResponse(false, 'Failed to remove.');
        $cartItem = $cartModel->find($cartItemID);
        $productId = $cartItem['product'];
        $stock = $cartItem['amount'];
        if ($cartModel->delete($cartItemID)) {
            $response = createResponse(true, 'Successfully removed.');
            (new ProductInventoryModel)->addStock($productId, $stock);
            (new NotificationsModel())->notifyCustomers($productId, 'Items back in stock!');
        }
        echo createAjaxResponse($response);
    }

    // No  time left to finish
    public function edit($cartID, $amount) {
        helper(['ajax', 'response']);
        // $response = [];
        // $shoppingCartModel = new CartModel();
        // if ($amount == 0) {
        // }
        // echo createAjaxResponse(['success' => $response]);
    }
}