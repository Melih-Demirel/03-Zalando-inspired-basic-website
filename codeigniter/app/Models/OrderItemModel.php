<?php

namespace App\Models;

use CodeIgniter\Model;


class OrderItemModel extends Model
{
    protected $primaryKey = 'order_item_id';
    protected $table = 'orderItem';
    protected $allowedFields = ['Order', 'product', 'delivery_date', 'order_status', 'amount'];
    
    protected function initialize()
    {
        helper(['response']);
    }
    
    public function completeOrderItem($order_item_id) {
        if (!$this->update($order_item_id, ['order_status' => 'Completed']))
            return createResponse(false, 'Failed to cancel order!');
        return createResponse(true, 'Completed order successfully');
    }

    public function cancelOrderItem($order_item_id) {   
        $this->update($order_item_id, ['order_status' => 'Cancelled']);
        $orderedItem = $this->getWhere(['order_item_id' => $order_item_id])->getFirstRow();
        $response = (new ProductInventoryModel())->addStock($orderedItem->product, $orderedItem->amount);
        if ($response['success'] == true)
            return createResponse(true, 'Successfully cancelled order!');
        return createResponse(false, 'Failed to cancel order!');
    }
}