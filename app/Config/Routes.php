<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

$routes->get('cliente', 'Cliente::index');
$routes->post('cliente', 'Cliente::store');
$routes->get('cliente/(:num)', 'Cliente::show/$1');
$routes->post('cliente/(:num)', 'Cliente::update/$1');
$routes->delete('cliente/(:num)', 'Cliente::destroy/$1');

$routes->get('ejecutivo', 'Ejecutivo::index');
$routes->post('ejecutivo', 'Ejecutivo::store');
$routes->get('ejecutivo/(:num)', 'Ejecutivo::show/$1');
$routes->post('ejecutivo/(:num)', 'Ejecutivo::update/$1');
$routes->delete('ejecutivo/(:num)', 'Ejecutivo::destroy/$1');

$routes->get('entidad', 'Entidad::index');
$routes->post('entidad', 'Entidad::store');
$routes->get('entidad/(:num)', 'Entidad::show/$1');
$routes->post('entidad/(:num)', 'Entidad::update/$1');
$routes->delete('entidad/(:num)', 'Entidad::destroy/$1');

$routes->get('poliza', 'Poliza::index');
$routes->post('poliza', 'Poliza::store');
$routes->get('poliza/(:num)', 'Poliza::show/$1');
$routes->post('poliza/(:num)', 'Poliza::update/$1');
$routes->delete('poliza/(:num)', 'Poliza::destroy/$1');

$routes->get('propuesta', 'Propuesta::index');
$routes->post('propuesta', 'Propuesta::store');
$routes->get('propuesta/(:num)', 'Propuesta::show/$1');
$routes->post('propuesta/(:num)', 'Propuesta::update/$1');
$routes->delete('propuesta/(:num)', 'Propuesta::destroy/$1');

$routes->get('tipoproducto', 'TipoProducto::index');
$routes->post('tipoproducto', 'TipoProducto::store');
$routes->get('tipoproducto/(:num)', 'TipoProducto::show/$1');
$routes->post('tipoproducto/(:num)', 'TipoProducto::update/$1');
$routes->delete('tipoproducto/(:num)', 'TipoProducto::destroy/$1');


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
