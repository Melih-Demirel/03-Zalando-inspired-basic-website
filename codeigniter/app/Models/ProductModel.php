<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model
{
    protected $primaryKey = 'product_id';
    protected $table = 'product';
    protected $allowedFields = ['name', 'description', 'seller', 'category', 'price'];
    
    protected function initialize()
    {
        helper(['response']);
    }

    

    public function getDetailsOfProducts($productArray) {
        for ($i=0; $i < count($productArray) ; $i++) { 
            $productArray[$i]['rating'] = (new ReviewModel())->getRatingOfProduct($productArray[$i]['product_id']);
            $productArray[$i]['img'] = null;
            $productImages = ($this->getImagesOfProduct($productArray[$i]['product_id']));
            if (count($productImages) > 0) {
                $productArray[$i]['img'] = $productImages[0]['img'];
            }
        }
        return $productArray;
    }

    public function getProducts($seller = null) {
        $products = [];
        if ($seller) 
            $products = db_connect()->table('productitem')->getWhere(['seller_id' => $seller])->getResultArray();
        else 
            $products = db_connect()->table('productitem')->get()->getResultArray();
        return $this->getDetailsOfProducts($products);
    }
    
    public function getImagesOfProduct($productId) {
        return (new ProductImageModel())->getWhere(['product' => $productId])->getResultArray();
    }
    
    public function getProductItem($productId) {
        $products = [];
        $reviewM = new ReviewModel();
        $products['product'] = db_connect()->table('productitem')->getWhere(['product_id' => $productId])->getResultArray()[0];
        $products['images'] = $this->getImagesOfProduct($productId);
        $products['rating'] = $reviewM->getRatingOfProduct($productId);
        $products['reviews'] = $reviewM->getReviewsOfProduct($productId);
        $products['items'] = (new ProductInventoryModel())->getWhere(['product' => $productId])->getResultArray();
        $products['videos'] = (new ProductVideoModel())->getWhere(['product' => $productId])->getResultArray();
        return $products;
    }
    
    public function getProductOfSeller($productId) {
        $products = [];
        $products['product'] = db_connect()->table('productitem')->getWhere(['product_id' => $productId])->getResultArray()[0]; 
        $products['images'] = $this->getImagesOfProduct($productId);
        $products['items'] = (new ProductInventoryModel())->getWhere(['product' => $productId])->getResultArray();
        $products['videos'] = (new ProductVideoModel())->getWhere(['product' => $productId])->getResultArray();
        
        return $products;
    }

    public function getFilteredProducts($filters) {
        $filterer = db_connect()->table('productItem');
        $filterer->groupStart();
        if ($filters['search'] != '')
            $filterer->like('name', $filters['search'], true);
        if ($filters['categories'])
            $filterer->whereIn('category_id', $filters['categories'], true);
        if ($filters['sellers'])
            $filterer->whereIn('seller_id', $filters['sellers'], true);
        if (($filters['minPrice'] && $filters['maxPrice']) && (intval($filters['minPrice']) < intval($filters['maxPrice']))) {
            $filterer->where("price >=", $filters['minPrice']);
            $filterer->where("price <=", $filters['maxPrice']);
        }
        $filterer->groupEnd();
        return $this->getDetailsOfProducts($filterer->get()->getResultArray());
    }

    
    public function addVideosToProduct($productId, $videos) {

        $productVideoModel = new ProductVideoModel();
        $productVideos = $productVideoModel->getWhere(['product' => $productId])->getResultArray();
        foreach ($productVideos as $video){
            $productVideoModel->delete(['video_id' => $video['video_id']]);
        }
        if ($videos == null)
            return;
        foreach ($videos as $video) {
            if ($video != "")
                (new ProductVideoModel())->insert(['product' => $productId, 'video_url' => $video]);
        }
    }

    public function addImagesToProduct($productId, $images) {
        foreach ($images as $image) {
            try {
                (new ProductImageModel())->insert(['product' => $productId, 'img' => file_get_contents($image)]);
            } catch (\Throwable $th) {
                
            }
        }
    }    
}