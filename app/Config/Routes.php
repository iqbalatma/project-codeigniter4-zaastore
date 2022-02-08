<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// AUTH
$routes->get('/', 'Auth::index');
$routes->get('/list-account', 'Auth::list_account');
$routes->post('/login', 'Auth::progress_login');
$routes->post('/registration-account', 'Auth::progress_registration');
$routes->post('/edit-account', 'Auth::progress_edit_registration');

// DASHBOARD
$routes->get('/dashboard', 'Dashboard::index');

// WAREHOUSE
$routes->get('/warehouse', 'Warehouse::index');
$routes->get('/warehouse-transaction', 'Warehouse::transaction');
$routes->get('/warehouse-unit', 'Warehouse::unit');
$routes->post('/warehouse-add-item', 'Warehouse::add_item');
$routes->post('/warehouse-edit-item', 'Warehouse::edit_item');
$routes->post('/warehouse-add-unit', 'Warehouse::add_unit');
$routes->post('/warehouse-edit-unit', 'Warehouse::edit_unit');
$routes->post('/warehouse-add-transaction', 'Warehouse::add_transaction');
$routes->post('/warehouse-edit-transaction', 'Warehouse::edit_transaction');


// ORDER
$routes->get('/add-order', 'Order::index');
$routes->get('/list-order/(:any)', 'Order::list_order/$1');
$routes->post('/order-edit-list', 'Order::edit');
$routes->post('/order-add-image', 'Order::add_image');
$routes->post('/order-delete', 'Order::delete');
$routes->post('/order-edit-image-design', 'Order::edit_image_design');


// ASSIGNMENT
$routes->get('/assignment', 'Assignment::index');
$routes->post('/assignment-to-technician', 'Assignment::progress_technician_assignment');
$routes->post('/assignment-to-installation', 'Assignment::progress_technician_assignment_installation');


// STATUS
$routes->get('/status-design', 'Status::design_print');
$routes->get('/status-production', 'Status::production');
$routes->get('/status-packing', 'Status::packing');
$routes->get('/status-checkout', 'Status::checkout');
$routes->get('/status-installation', 'Status::installation');
$routes->get('/update-status-design/(:any)', 'Status::update_status_design/$1');
$routes->get('/update-status-production/(:any)', 'Status::update_status_production/$1');
$routes->get('/update-status-packing/(:any)', 'Status::update_status_packing/$1');
$routes->post('/update-status-checkout', 'Status::update_status_checkout');
$routes->post('/update-status-installation', 'Status::update_status_installation');

// PAYMENT
$routes->get('/payment/(:any)', 'Payment::index/$1');
$routes->post('/payment-transaction', 'Payment::payment_transaction');

// TECHNICIAN
$routes->get('/technician/(:any)', 'Technician::index/$1');
$routes->get('/technician-all', 'Technician::all_technician/$1');
$routes->get('/technician-by/(:any)', 'Technician::by_technician/$1');


$routes->post('/technician-update-technician', 'Technician::update_technician');
$routes->post('/technician-report-done', 'Technician::report_product');
$routes->post('/technician-request-warehouse', 'Technician::request_warehouse');

// INSTALLATION
$routes->get('/installer/(:any)', 'Installer::index/$1');
$routes->get('/installer-all/(:any)', 'Installer::all_installer/$1');
$routes->get('/installer-by/(:any)', 'Installer::by_installer/$1');
$routes->post('/installer-update-installer', 'Installer::update_installer');
$routes->post('/installer-report-installation', 'Installer::report_installation');





/**
 * RESTFULL API
 */
// PAYMENT API
$routes->get('/api/payment/(:any)', 'RESTAPI\PaymentApi::show/$1');
$routes->get('/api/payment-left/(:any)', 'RESTAPI\PaymentApi::paymentLeft/$1');

$routes->get('/api/payment-paid-off/(:any)/(:any)/(:any)', 'RESTAPI\PaymentApi::showPaidOff/$1/$2/$3');
$routes->get('/api/payment-paid-off/(:any)', 'RESTAPI\PaymentApi::showPaidOff/$1');


// TECHNICIAN
$routes->get('/api/technician-progress', 'RESTAPI\TechnicianApi::showDataOrderOnTechnician'); //on progress
$routes->get('/api/technician-done/(:any)', 'RESTAPI\TechnicianApi::showDataOrderOnTechnician/$1'); //done all / this month
$routes->get('/api/technician-all-done-monthly/(:any)/(:any)/(:any)', 'RESTAPI\TechnicianApi::showDataOrderOnTechnician/$1/$2/$3'); //done monthly

$routes->get('/api/technician-name/(:any)', 'RESTAPI\TechnicianApi::showTechnicianName/$1');


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
