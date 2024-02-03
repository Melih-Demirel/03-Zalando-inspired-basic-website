<?php

namespace App\Controllers;


use App\Models\ReviewModel;
use App\Models\ProductModel;

class Review extends BaseController
{    

    public function create($product) {
        return view('customer/createReview', (new ProductModel())->getProductItem(esc($product)));
    }
    
    public function add() {
        helper(['ajax']);
        $data = ['product' => esc($this->request->getVar('product_id')), 
                'customer' => session()->get('roleId'), 
                'rating' => esc($this->request->getVar('rating')),
                'comment' => esc($this->request->getVar('comment'))
        ];
        if ((new ReviewModel())->insert($data))
            $response = ['success' => TRUE, 'message' => 'Successfully created a review.'];
        else
            $response = ['success' => FALSE, 'message' => 'Failed to create a review.'];

        echo createAjaxResponse($response);
    }

}
