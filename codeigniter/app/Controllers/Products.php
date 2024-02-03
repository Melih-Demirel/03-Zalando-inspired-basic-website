<?php

namespace App\Controllers;

use App\Models\SellerModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductInventoryModel;

class Products extends BaseController
{
    
    public function index()
    {
        $products = (new ProductModel())->getProducts();
        $categories = (new CategoryModel())->get()->getResultArray();
        $sellers = (new SellerModel())->get()->getResultArray();
        $minPrice = floor((new ProductModel())->builder()->selectMin('price')->get()->getFirstRow()->price);
        $maxPrice = round((new ProductModel())->builder()->selectMax('price')->get()->getFirstRow()->price);
        $givenMinPrice = $minPrice;
        $givenMaxPrice = $maxPrice;
        return view('products/products', ['products' => $products, 'sellers' => $sellers, 'categories' => $categories,
                    'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'givenMinPrice' => $givenMinPrice, 'givenMaxPrice' => $givenMaxPrice,
                    'givenSearch' => '', 'checkedCategories' => [], 'checkedSellers' => []]);
    }
    
    public function filter() {
        
        $givenSearch = esc($this->request->getVar('search'));
        $checkedCategories = $this->request->getVar('category[]');
        $checkedSellers = $this->request->getVar('seller[]');
        $givenMinPrice = esc($this->request->getVar('minPrice'));
        $givenMaxPrice = esc($this->request->getVar('maxPrice'));

        $filterData = [
            'minPrice' => $givenMinPrice,
            'maxPrice' => $givenMaxPrice,
            'categories' => $checkedCategories,
            'sellers' => $checkedSellers,
            'search' => $givenSearch
        ];
        
        $products = (new ProductModel())->getFilteredProducts($filterData);
        $sellers = (new SellerModel())->get()->getResultArray();
        $categories = (new CategoryModel())->get()->getResultArray();
        $minPrice = floor((new ProductModel())->builder()->selectMin('price')->get()->getFirstRow()->price);
        $maxPrice = round((new ProductModel())->builder()->selectMax('price')->get()->getFirstRow()->price);
        return view('products/products', ['products' => $products, 'sellers' => $sellers, 'categories' => $categories, 
                    'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'givenMinPrice' => $givenMinPrice, 'givenMaxPrice' => $givenMaxPrice,
                    'givenSearch' => $givenSearch, 'checkedCategories' => $checkedCategories, 'checkedSellers' => $checkedSellers]);
    }
    
    public function product($productId) {
        $productModel = new ProductModel();
        $product_data = $productModel->getProductItem(esc($productId));
        $session = session();
        $sellerModel = new SellerModel();
        $product_data['bg_color'] = $sellerModel->getWhere(['seller_id' => $product_data['product']['seller_id']])->getFirstRow()->bg_color;
        $product_data['text_color'] = $sellerModel->getWhere(['seller_id' => $product_data['product']['seller_id']])->getFirstRow()->text_color;
        
        $isCustomer = ($session->get('userType') == 'Customer');
        return view('products/product', ['product_data'=>$product_data, 'isCustomer'=>$isCustomer]);
    }

    public function add() {
        $productModel = new ProductModel();
        $data = [
            'name' => esc($this->request->getVar('name')),
            'description' => esc($this->request->getVar('description')),
            'price' => esc($this->request->getVar('price')),
            'category' => esc($this->request->getVar('category')),
            'seller' => esc($this->request->getVar('seller'))
        ];
        $images = $this->request->getFileMultiple('images');
        $size = esc($this->request->getVar('size[]'));
        $stock = esc($this->request->getVar('stock[]'));
        $videos = esc($this->request->getVar('video[]'));

        $id = $productModel->insert($data);
        $productModel->addImagesToProduct($id, $images);
        $productModel->addVideosToProduct($id, $videos);
        
        if ($stock || $size ) {
            (new ProductInventoryModel())->updateStock($id,$stock, $size);
        } 
        return redirect()->to(base_url() . '/seller/products'); 
    }

    public function delete() {
        helper(['ajax']);
        $response = [];
        $productId = esc($this->request->getVar('product'));
        $productModel = new ProductModel();
        if (!$productModel->delete(['product_id' => $productId]))
            $response = ['success' => FALSE, 'message' => 'Failed to delete product id: ' . $productId];           
        else 
            $response = ['succcess' => TRUE, 'message' => 'Successfully deleted product.'];
        echo createAjaxResponse($response);
    }

    public function edit($productId) {
        $productModel = new ProductModel();
        $data = [
            'name' => esc($this->request->getVar('name')),
            'description' => esc($this->request->getVar('description')),
            'price' => esc($this->request->getVar('price')),
        ];
        $images = $this->request->getFileMultiple('images');
        $videos = esc($this->request->getVar('video[]'));
        $size = esc($this->request->getVar('size[]'));
        $stock = esc($this->request->getVar('stock[]'));
        
        $productModel->update($productId, $data);
        $productModel->addImagesToProduct($productId, $images);
        $productModel->addVideosToProduct($productId, $videos);

        if ($stock || $size) {
            (new ProductInventoryModel())->updateStock($productId,$stock, $size);
        } 
        return redirect()->to(base_url() . '/seller/products'); 
    }
    
    public function removeImage() {
        helper(['ajax']);
        $response = [];
        $id = esc($this->request->getVar('imageId'));
        if ((new ProductImageModel())->delete(['img_id' => $id]))
            $response = ['succcess' => TRUE, 'message' => 'Successfully deleted image.'];
        else 
            $response = ['success' => FALSE, 'message' => 'Failed to delete image.'];
        echo createAjaxResponse($response);
    }

}