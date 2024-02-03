<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $primaryKey = 'review_id';
    protected $table = 'productreview';
    protected $allowedFields = ['product', 'customer', 'rating', 'comment'];
   
    protected function initialize()
    {
    }
    
    public function getReviewsOfProduct($productId) {
        return db_connect()->table('reviewitem')->getWhere(['product' => $productId])->getResultArray(); 
    }

    public function getRatingOfProduct($productId) {
        $stars = db_connect()->query('SELECT AVG(rating) as rating from ProductReview WHERE product = ' . $productId)->getFirstRow()->rating;
        return ($stars ? $stars : 0);
    }
}