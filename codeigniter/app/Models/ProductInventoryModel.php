<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductInventoryModel extends Model
{
    protected $primaryKey = 'product_inventory_id';
    protected $table = 'productinventory';
    protected $allowedFields = ['product', 'size', 'stock'];
    
    protected function initialize()
    {
        helper(['response']);
    }

    public function hasStock($id) {
        $res = $this->getWhere(['product_inventory_id' => $id])->getFirstRow();
        return ($res && $res->stock > 0);
    }

    public function addStock($productId, $amount) {
        $stock = $this->getWhere(['product_inventory_id' => $productId])->getFirstRow()->stock;
        if ($this->update($productId, ['stock' => ($stock + $amount)]))
            return createResponse(true, 'Successfully updated stock');    
        return createResponse(true, 'Failed to update!');
        
    }
    
    public function updateStock($productId, $stock, $size) {
        for ($i = 0; $i < count($size); $i++) {
            $res = $this->getWhere(['product' => $productId, 'size' => $size[$i]]);
            if ($res->getNumRows() > 0) {
                $firstR = $res->getFirstRow();
                $stockWithoutUpdate = $firstR->stock;
                $this->update($firstR->product_inventory_id, ['stock' => $stock[$i]]);
                $stockAfterUpdate = $this->find($firstR->product_inventory_id)['stock'];
                if ($stockWithoutUpdate == 0 && $stockAfterUpdate > 0) {
                    (new NotificationsModel())->notifyCustomers($firstR->product_inventory_id, 'Items are back in stock!');
                }
            } else {
                $this->insert(['product' => $productId, 'size' => $size[$i], 'stock' => $stock[$i]]);
            }
        }
        $allSizes = $this->getWhere(['product' => $productId])->getResultArray();
        for ($i = 0; $i < count($allSizes); $i++) {
            if(!in_array($allSizes[$i]['size'], $size)){
                $this->delete(['product_inventory_id' => $allSizes[$i]['product_inventory_id']]);
            }
        }
    }

}