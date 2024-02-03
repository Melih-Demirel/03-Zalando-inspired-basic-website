<?php

namespace App\Controllers;

use App\Models\WishlistModel;

class Wishlist extends BaseController
{    

    public function index()
    {   
        return view('customer/wishlist.php', ['items' => (new WishlistModel())->getWishlistOfCustomer(session()->get('roleId'))]);
    }
    
    public function add() {
        helper(['ajax']);
        $res = (new WishlistModel())->addProductToWishlist(session()->get('roleId'), esc($this->request->getVar('product')));
        echo createAjaxResponse($res);
    }
}