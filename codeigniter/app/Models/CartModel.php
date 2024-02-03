<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class CartModel extends Model
{
    protected $primaryKey = 'cart_item_id';
    protected $table = 'shoppingcart';
    protected $allowedFields = ['customer', 'product', 'amount',' added_at'];
    
    protected function initialize()
    {
        helper(['response']);
    }
    
    public function getCartOfCustomer($customerId) {
        $products = db_connect()->table('shoppingcartview')->getWhere(['customer' => $customerId])->getResultArray();
        return (new ProductModel())->getDetailsOfProducts($products);
    }

    public function addProductToCart($customerId, $productId) {
        if (!(new ProductInventoryModel())->hasStock($productId))
            return createResponse(false, 'Item out of stock.');
        $inCart = $this->getWhere(['customer' => $customerId, 'product' => $productId])->getFirstRow();
        if ($inCart) {
            $this->update($inCart->cart_item_id, ['amount' => $inCart->amount + 1, 'added_at' => (new Time(""))->toDateTimeString()]);
        } 
        else {
            $this->insert(['customer' => $customerId, 'amount' => 1, 'product' => $productId, 'added_at' => (new Time(""))->toDateTimeString()]);
        }
        (new ProductInventoryModel())->addStock($productId, -1);
        return createResponse(true, 'Added Item To Cart.');
    }
    
    public function clearCartOfCustomer($customerId) {
        $items = $this->getWhere(['customer' => $customerId])->getResultArray();
        foreach ($items as $item )
            $this->delete(['cart_item_id' => $item['cart_item_id']]);
    }
}