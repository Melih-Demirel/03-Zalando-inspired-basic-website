<?php

namespace App\Controllers;

use App\Models\SellerModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\CategoryModel;

class Seller extends BaseController
{
    public function account() {
        $sellerM = (new SellerModel());
        $seller = session()->get('roleId');
        $sellerData = $sellerM->getDataOfSeller($seller);
        $sellerData['images'] = $sellerM->getImagesOfSeller($seller);
        return view('seller/account', ['seller' => $sellerData]);
    }
    
    public function products() {
        return view('seller/products', ['products' => (new ProductModel())->getProducts(intval(session()->get('roleId')))]);
    }

    public function addProduct() {
        return view('seller/addProduct', ['categories' => (new CategoryModel())->get()->getResultArray()]);   
    }

    public function editProduct($productID) {
        return view('seller/editProduct', ['product' => (new ProductModel())->getProductOfSeller(esc($productID)), 'categories' => (new CategoryModel())->get()->getResultArray()]);
    }
    
    public function orders() {
        return view('seller/orders', ['orders' => (new OrderModel())->getOrdersSeller(session()->get('roleId'))]);
    }

    public function profile($sellerID) {
        $sellerM = (new SellerModel());
        $sellerInfo = $sellerM->getDataOfSeller($sellerID);
        $sellerInfo['images'] = $sellerM->getImagesOfSeller($sellerID);
        return view('seller/profile', ['seller' => $sellerInfo, 'products' => (new ProductModel())->getProducts($sellerID)]);
    }

    public function edit() {
        $sellerM = new SellerModel();
        $seller = $this->request->getVar('seller');
        $sellerData = [
            'name' => esc($this->request->getVar('name')),
            'description' => esc($this->request->getVar('description')),
            'bg_color' => esc($this->request->getVar('bg_color')),
            'text_color' => esc($this->request->getVar('text_color'))
        ];
        $images = $this->request->getFileMultiple('images');
        $sellerM->update($seller, $sellerData);
        $sellerM->saveImagesOfSeller($seller, $images);
        return redirect()->to(base_url() . '/seller/account');
    }

    public function removeImage() {
        helper(['ajax']);
        $response = [];
        $id = esc($this->request->getVar('imageId'));
        $res = db_connect()->table('sellerimages')->delete(['img_id' => $id]);
        if ($res)
            $response = ['success' => TRUE, 'message' => 'Removed Image From Seller'];
        else 
            $response = ['success' => FALSE, 'message' => 'Failed to remove image'];
        echo createAjaxResponse($response);
    }

}