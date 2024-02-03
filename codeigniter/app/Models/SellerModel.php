<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class SellerModel extends Model
{
    protected $primaryKey = 'seller_id';
    protected $table = 'seller';
    protected $allowedFields = ['user', 'name', 'description','bg_color','text_color'];
    
    protected function initialize()
    {
    }
    
    public function getDataOfSeller($sellerId) {
        $sellerData = $this->getWhere(['seller_id' => $sellerId])->getFirstRow('array');
        $sellerData['email'] = (new UserModel())->getWhere(['user_id' => $sellerData['user']])->getFirstRow()->email;
        return $sellerData;
    }
    
    public function getImagesOfSeller($sellerId) {
        return db_connect()->table('sellerimages')->getWhere(['seller' => $sellerId])->getResultArray();
    }
    
    public function saveImagesOfSeller($sellerId, $images) {
        foreach ($images as $image) {
            try {
                $data['seller'] = $sellerId;
                $data['img'] = file_get_contents($image);
                db_connect()->table('sellerimages')->insert($data);
            } catch (\Throwable $th) {}
        }
    }
}