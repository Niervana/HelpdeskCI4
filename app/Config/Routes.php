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
$routes->get('forgetfp', 'Absensi::index');
$routes->get('attendancedatafingerprint', 'Absensi::attendance');
$routes->get('userdatafingerprint', 'Absensi::datauser');
// -------------------------------------------------------------
// karyawan
$routes->get('karyawan', 'Karyawan::index');
$routes->get('karyawan/add', 'Karyawan::add');
$routes->post('karyawan', 'Karyawan::insert');
$routes->get('karyawan/edit/(:num)', 'Karyawan::edit/$1');
$routes->put('karyawan(:any)', 'Karyawan::update/$1');
$routes->delete('karyawan(:segment)', 'Karyawan::delete/$1');
$routes->get('karyawan/detail', 'Karyawan::show_detail');
$routes->post('karyawan/import', 'Karyawan::import');

// ----------------------------------------------------------
// kontrak
$routes->get('kontrak', 'Kontrak::index');
$routes->get('kontrak/edit/(:num)', 'Kontrak::edit/$1');
$routes->put('kontrak(:any)', 'Kontrak::updatekontrak/$1');

// ----------------------------------------------------------
// account
$routes->get('account', 'Account::index');
$routes->get('account/add', 'Account::add');
$routes->delete('account(:segment)', 'Account::delete/$1');
$routes->get('account/move/(:num)', 'Account::move/$1');

//-----------------------------------------------------------
// timesheets
$routes->get('attendance', 'Timesheets::attendance');
$routes->get('officeshift', 'Timesheets::officeshift');
//-----------------------------------------------------------
// tiketing
$routes->get('tiket', 'Tiket::index');
$routes->get('tiket/reply', 'Tiket::reply');
$routes->post('tiket', 'Tiket::insert');
$routes->delete('tiket(:segment)', 'Tiket::delete/$1');
//-----------------------------------------------------------
// PKL
$routes->get('pkl', 'PKL::index');
$routes->get('pkl/add', 'PKL::add');
$routes->post('pkl', 'PKL::insert');
$routes->get('pkl/edit/(:num)', 'PKL::edit/$1');
$routes->put('pkl(:any)', 'PKL::update/$1');
$routes->delete('pkl(:segment)', 'PKL::delete/$1');
$routes->get('pkl/import', 'PKL::import_csv');
$routes->get('pkl/sertifikat', 'PKL::sertifikat');
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
