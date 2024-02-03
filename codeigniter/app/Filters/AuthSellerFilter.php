<?php
namespace App\Filters;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthSellerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $loggedIn = session()->get('loggedIn');
        if (!$loggedIn || (session()->get('userType') != 'Seller' && $loggedIn))
            return redirect()->to(base_url() . '/auth');
    
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        
    }
}