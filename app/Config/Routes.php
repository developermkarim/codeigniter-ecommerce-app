<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/','Home::home');
$routes->get('/signup', 'UserSignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'UserSignupController::store');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'UserSigninController::loginAuth');
$routes->get('/signin', 'UserSigninController::index');
$routes->get('/signout', 'UserSigninController::signout');
// $routes->get('/', 'Home::home',['filter'=>'noauth']);
// $routes->get('login', 'Home::signin',['filter'=>'noauth']);

// $routes->get('logout', 'Home::logout',['filter'=>'noauth']);

// $routes->match(['get','post'],'signup','Home::signup',['filter'=>'noauth']);
// //  $routes->post('create-signup','Home::signup');
// $routes->get('dashboard','Home::dashboard',['filter'=>'auth']);



/* Admin Route Here */
$routes->get('/admin','AdminController::index');
$routes->post('admin_signin','AdminController::signin');
$routes->match(['get','post'],'/admin/dashboard','AdminController::dashboard');
$routes->get('admin_logout','AdminController::logout');

$routes->match(['get','post'],'/admin/category','AdminController::category');

$routes->match(['get','post'],'/admin/product','ProductController::index');
$routes->match(['get','post'],'/admin/inser_product','ProductController::product');

$routes->match(['get','post'],'productlist/(:any)','Home::productList/$1');

$routes->match(['get','post'],'showProductDetails/(:any)','Home::productDetails/$1');

$routes->match(['get','post'],'/admin/productList','ProductController::allProductList');
$routes->match(['get','post'],'/admin/categoryList','ProductController::allCategoryList');

/* add to card here  */
$routes->post('addCart','Home::addToCart',['filter' => 'authGuard']);
// $routes->get('admin/user','AdminController::logout');
/*
 * -------------------- ------------------------------------------------
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
