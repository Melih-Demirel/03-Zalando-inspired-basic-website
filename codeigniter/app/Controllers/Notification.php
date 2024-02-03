<?php

namespace App\Controllers;

use App\Models\NotifyProductModel;

class Notification extends BaseController
{
    public function index($productId) {
        $notifyProductM = new NotifyProductModel();
        $notifyProductM->addCustomerToProductNotification(session()->get('roleId'), esc($productId));
        return redirect()->to(base_url() . '/products');
    }
}