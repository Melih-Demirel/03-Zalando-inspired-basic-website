<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class WishlistModel extends Model
{
    protected $primaryKey = 'item_id';
    protected $table = 'wishlist';
    protected $allowedFields = ['customer', 'product', 'added_at'];
    
    protected function initialize()
    {
        helper(['response']);
    }

    public function getWishlistOfCustomer($customerId) {
        return (new ProductModel())->getDetailsOfProducts(db_connect()->table('wishlistview')->getWhere(['customer' => $customerId])->getResultArray());
    }

    public function addProductToWishlist($customerId, $productId) {
        $found = $this->getWhere(['customer' => $customerId, 'product' => $productId])->getFirstRow();
        if ($found) {
            $this->delete($found->item_id);
            return createResponse(true, 'Removed Item from Wishlist.');
        } else {
            $this->insert(['customer' => $customerId, 'product' => $productId, 'added_at' => (new Time(""))->toDateTimeString()]);
            return createResponse(true, 'Added item to wishlist.');
        }  
    }
}