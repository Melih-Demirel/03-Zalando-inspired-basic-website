<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


/* Auth routes */

$routes->group('auth', function($routes) {
    $routes->add('/', 'Auth::index');
    $routes->add('register', 'Auth::register');
    $routes->add('register/customer', 'Auth::registerCustomer');
    $routes->add('register/seller', 'Auth::registerSeller');
    $routes->add('forgot-password', 'Auth::forgotPassword');
    $routes->add('send-verification-mail/(:any)', 'Auth::sendVerificationMail/$1');
    $routes->add('recover-user/(:any)', 'Auth::recoverUser/$1');
    $routes->add('reset-password/(:num)', 'Auth::resetPassword/$1');
    $routes->add('verify/(:any)', 'Auth::verifyUser/$1');
    $routes->group('', ['filter' => 'auth:before'], function($routes) {
        $routes->add('signout', 'Auth::signout');
    });
});

/* Seller Routes */
$routes->group('seller', [], function($routes) {
    $routes->get('profile/(:num)', 'Seller::profile/$1');

    $routes->group('', ['filter' => 'authSeller:before'], function($routes) {
        
        $routes->post('removeImage', 'Seller::removeImage');
        $routes->post('edit', 'Seller::edit');
        
        $routes->get('account', 'Seller::account');
        $routes->get('products', 'Seller::products');
        $routes->get('products/add', 'Seller::addProduct');
        $routes->get('products/(:num)', 'Seller::editProduct/$1');
        $routes->get('orders', 'Seller::orders');
        
    });
});

/* Customer Routes */
$routes->group('customer', ['filter' => 'authCustomer:before'], function($routes) {
    $routes->add('account', 'Customer::account');
    $routes->add('orders', 'Customer::orders');
    $routes->add('notifications', 'Customer::notifications');
});



/* Products Route */
$routes->group('products', [], function($routes) {
    $routes->group('', ['filter' => 'auth:before'], function($routes) {
        $routes->get('/', 'Products::index');
        $routes->get('filter', 'Products::filter');
        $routes->get('(:num)', 'Products::product/$1');    
    });

    $routes->group('', ['filter' => 'authSeller:before'], function($routes) {
        $routes->post('edit/(:num)', 'Products::edit/$1');
        $routes->post('add', 'Products::add');
        $routes->post('removeImage', 'Products::removeImage');
        $routes->post('delete', 'Products::delete');
    });
});


/* Cart Routes */
$routes->group('cart', ['filter' => 'authCustomer:before'], function($routes) {
    $routes->get('/', 'Cart::index');
    $routes->post('add', 'Cart::add');
    $routes->post('remove', 'Cart::remove');
    $routes->post('edit', 'Cart::edit');
});

/* Wishlist Routes */
$routes->group('wishlist', ['filter' => 'authCustomer:before'], function($routes) {
    $routes->get('/', 'Wishlist::index');
    $routes->post('add', 'Wishlist::add');
});

/* Order Routes */
$routes->group('order', ['filter' => 'auth:before'], function($routes) {
    $routes->get('/', 'Order::index');
    $routes->get('success', 'Order::success');
    $routes->post('cancel', 'Order::cancel');
    $routes->post('complete', 'Order::complete');
});

/* Reviews Routes */
$routes->group('review', ['filter' => 'authCustomer:before'], function($routes) {
    $routes->get('create/(:num)', 'Review::create/$1');
    $routes->post('add', 'Review::add');
});


/* Chat Routes */
$routes->group('chat', ['filter' => 'auth:before'], function($routes) {
    $routes->get('inbox', 'Chat::index');
    $routes->get('(:num)', 'Chat::chat/$1');
    $routes->post('addMessage', 'Chat::addChatMessage');
    $routes->get('getMessage', 'Chat::getChatMessages');
});

$routes->group('notify', ['filter' => 'authCustomer:before'], function($routes) {
    $routes->get('(:num)', 'Notification::index/$1');
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
