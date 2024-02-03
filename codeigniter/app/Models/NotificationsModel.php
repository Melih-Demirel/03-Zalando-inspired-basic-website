<?php

namespace App\Models;

use CodeIgniter\Model;
class NotificationsModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
    protected $allowedFields = ['product', 'customer', 'text', 'added_at', 'viewed'];

    protected function initialize()
    {
        
    }

    public function getNotificationsOfCustomer($customerId) {
        return db_connect()->table('notificationView')->getWhere(['customer' => $customerId])->getResultArray();
    }
    
    public function notifyCustomers($productId, $text) {
        $notifyProductModel = new NotifyProductModel();
        $toNotifyCustomers = $notifyProductModel->getWhere(['product' => $productId])->getResultArray();
        foreach ($toNotifyCustomers as $toNotifyCustomer) {
            if (!$this->getWhere(['customer' => $toNotifyCustomer['customer'], 'product' => $productId, 'viewed' => 0])->getFirstRow()) {
                $this->insert(['product' => $productId, 'customer' => $toNotifyCustomer['customer'], 'text' => $text]);
            }
        }
    }
    
    public function setNotificationsToRead($customerId) {
        $notifications = $this->getWhere(['customer' => $customerId])->getResultArray();
        foreach ($notifications as $notification) {
            if ($this->find($notification['notification_id'])){
                $this->update($notification['notification_id'], ['viewed' => 1]);
            }
        }
    }
}