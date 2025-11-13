<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(true);
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
$routes->get('create-db', function () {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('ithelpdesk')) {
        echo 'Database telah dibuat';
    }
});

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->get('forgot', 'Auth::forgot');
$routes->get('verifikasi', 'Auth::verifikasi');
$routes->post('register', 'Auth::insertdata');
$routes->addRedirect('/', 'Home');

//exception------------------------------------------------------

//mesin absensi-------------------------------------------------
// $routes->get('forgetfp', 'Absensi::index');
// $routes->get('attendancedatafingerprint', 'Absensi::attendance');
// $routes->get('userdatafingerprint', 'Absensi::datauser');
// -------------------------------------------------------------
// inventory
$routes->get('inventory', 'Inventory::index');
$routes->get('inventory/add', 'Inventory::add');
$routes->post('inventory/insert', 'Inventory::insert');
$routes->get('inventory/edit/(:num)', 'Inventory::edit/$1');
$routes->put('inventory/update/(:num)', 'Inventory::update/$1');
$routes->delete('inventory/(:num)', 'Inventory::delete/$1');
$routes->get('inventory/detail/(:num)', 'Inventory::show_detail/$1');
$routes->post('inventory/import', 'Inventory::import');
$routes->get('inventory/print-main', 'Inventory::printMain');
$routes->get('inventory/print-support', 'Inventory::printSupport');
$routes->get('inventory/excel', 'Inventory::excel');
$routes->get('inventory/log', 'Inventory::log');

// CCTV routes
$routes->get('cctv', 'Cctv::index');
$routes->get('cctv/add', 'Cctv::add');
$routes->post('cctv/insert', 'Cctv::insert');
$routes->get('cctv/edit/(:num)', 'Cctv::edit/$1');
$routes->put('cctv/update/(:num)', 'Cctv::update/$1');
$routes->delete('cctv/(:num)', 'Cctv::delete/$1');
$routes->get('cctv/detail/(:num)', 'Cctv::show_detail/$1');

// ----------------------------------------------------------
// kontrak
// $routes->get('kontrak', 'Kontrak::index');
// $routes->get('kontrak/edit/(:num)', 'Kontrak::edit/$1');
// $routes->put('kontrak(:any)', 'Kontrak::updatekontrak/$1');

// ----------------------------------------------------------
// account
$routes->get('account', 'Account::index');
$routes->get('account/add', 'Account::add');
$routes->delete('account(:segment)', 'Account::delete/$1');
$routes->get('account/move/(:num)', 'Account::move/$1');

//-----------------------------------------------------------
// timesheets
// $routes->get('attendance', 'Timesheets::attendance');
// $routes->get('officeshift', 'Timesheets::officeshift');
//-----------------------------------------------------------
// tiketing
$routes->get('tiket', 'Tiket::index');
$routes->post('tiket', 'Tiket::store');
$routes->delete('tiket(:segment)', 'Tiket::delete/$1');
$routes->get('tiket/detail/(:num)', 'Tiket::detail/$1');
$routes->get('tiket/print', 'Tiket::print');
$routes->get('tiket/excel', 'Tiket::excel');
$routes->get('tiket/getFilteredData', 'Tiket::getFilteredData');
//-----------------------------------------------------------
// PKL
// $routes->get('pkl', 'PKL::index');
// $routes->get('pkl/add', 'PKL::add');
// $routes->post('pkl', 'PKL::insert');
// $routes->get('pkl/edit/(:num)', 'PKL::edit/$1');
// $routes->put('pkl(:any)', 'PKL::update/$1');
// $routes->delete('pkl(:segment)', 'PKL::delete/$1');
// $routes->get('pkl/import', 'PKL::import_csv');
// $routes->get('pkl/sertifikat', 'PKL::sertifikat');
// $routes->get('pkl(:num)', 'PKL::cetakSertifikat/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
