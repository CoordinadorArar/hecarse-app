<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('logout', 'LoginController::logout');
$routes->post('/verifyUser', 'LoginController::verifyUser');
$routes->post('/cerrar_sesion', 'LoginController::cerrar_sesion');
$routes->get('/obtener_usuario/(:num)', 'Admin\UsuariosController::getUserById/$1');


/**
 * Rutas para recuperación de contraseña
 */
$routes->get('recover/', 'RecoverController::index');
$routes->get('resetPass/(:any)', 'ResetPassController::index/$1');
$routes->post('recover/verifyEmail', 'RecoverController::verifyEmail');
$routes->post('recover/envioEnlace', 'RecoverController::envioEnlace');
$routes->post('resetPass/verifyPasswords', 'ResetPassController::verifyPasswords');

/**
 * Rutas de la loseta
 */
$routes->get('losetas/', 'LosetasController::index');

/** Rutas de la loseta "Administracion"*/
$routes->get('admin/onboarding/(:num)', 'Admin\AdminController::index/$1');
$routes->get('admin/modulos/(:num)', 'Admin\ModulosController::index/$1');
$routes->get('admin/roles/(:num)', 'Admin\RolesController::index/$1');
$routes->get('admin/usuarios/(:num)', 'Admin\UsuariosController::index/$1');
$routes->get('admin/acciones/(:num)', 'Admin\AccionesController::index/$1');
$routes->get('admin/tabs/(:num)', 'Admin\TabsController::index/$1');

/** Rutas de módulo usuarios */
$routes->post('admin/usuarios/(:num)', 'Admin\UsuariosController::getUserById/$1');
$routes->post('admin/usuarios/actualizarUsuario', 'Admin\UsuariosController::updateUser');
$routes->post('admin/usuarios/updatePass', 'Admin\UsuariosController::updatePass');
$routes->post('admin/usuarios/buscarUsuario', 'Admin\UsuariosController::findUserByName');
$routes->post('admin/usuarios/buscarUsuariosActivos', 'Admin\UsuariosController::getActiveUsers');
$routes->post('admin/usuarios/obtenerRolesUsuario', 'Admin\UsuariosController::getAllRolesByUser');
$routes->post('admin/usuarios/quitarRolUsuario', 'Admin\UsuariosController::deleteUserRole');
$routes->post('admin/usuarios/asignarRolUsuario', 'Admin\UsuariosController::addUserRole');
$routes->post('admin/usuarios/actualizarRolUsuarios', 'Admin\UsuariosController::addUsersRole');
$routes->post('admin/usuarios/crearUsuario', 'Admin\UsuariosController::createUser');
$routes->post('admin/usuarios/guardarFotoPerfil', 'Admin\UsuariosController::guardarFotoPerfil');

/**Rutas de consultas varias de admin */
$routes->post('admin/admin/obtenerDepartamentos', 'Admin\AdminController::getDepartamentos');
$routes->post('admin/admin/obtenerCiudades', 'Admin\AdminController::getCiudades');
$routes->get('admin/documentos/(:any)', 'Admin\AdminController::getDocumentos/$1');

/** Rutas de módulo roles */
$routes->post('admin/roles/(:num)', 'Admin\RolesController::getRolById/$1');
$routes->post('admin/roles/actualizarRol', 'Admin\RolesController::updateRol');
$routes->post('admin/roles/buscarRol', 'Admin\RolesController::findRolByName');
$routes->post('admin/roles/obtenerModulosRol', 'Admin\RolesController::getAllModulesByRol');
$routes->post('admin/roles/quitarModuloRol', 'Admin\RolesController::deleteRolModule');
$routes->post('admin/roles/asignarModuloRol', 'Admin\RolesController::addRolModule');
$routes->post('admin/roles/actualizarModuloRoles', 'Admin\RolesController::addRolsModule');
$routes->post('admin/roles/crearRol', 'Admin\RolesController::createRol');

/** Rutas de módulo administración de módulos */
$routes->post('admin/modulos/(:num)', 'Admin\ModulosController::getModuleById/$1');
$routes->post('admin/modulos/obtenerModulosLoseta', 'Admin\ModulosController::getModulesByLosetaId');
$routes->post('admin/modulos/crearModulo', 'Admin\ModulosController::createModule');
$routes->post('admin/modulos/actualizarModulo', 'Admin\ModulosController::updateModule');
$routes->post('admin/modulos/buscarModulo', 'Admin\ModulosController::findModuleByName');
$routes->post('admin/modulos/quitarModulo', 'Admin\ModulosController::deleteModule');

/** Rutas de módulo administración de acciones */
$routes->post('admin/acciones/(:num)', 'Admin\AccionesController::getAccionById/$1');
$routes->post('admin/acciones/crearAccion', 'Admin\AccionesController::createAccion');
$routes->post('admin/acciones/actualizarAccion', 'Admin\AccionesController::updateAccion');
$routes->post('admin/acciones/buscarRol', 'Admin\AccionesController::findRolByName');
$routes->post('admin/acciones/obtenerAccionesRol', 'Admin\AccionesController::getAllAccionByRol');
$routes->post('admin/acciones/quitarAccionRol', 'Admin\AccionesController::deleteRolAccion');
$routes->post('admin/acciones/asignarAccionRol', 'Admin\AccionesController::addRolAccion');

/** Rutas de módulo administración de pestañas */
$routes->post('admin/tabs/(:num)', 'Admin\TabsController::getTabById/$1');
$routes->post('admin/tabs/crearTab', 'Admin\TabsController::createTab');
$routes->post('admin/tabs/actualizarTab', 'Admin\TabsController::updateTab');
$routes->post('admin/tabs/buscarRol', 'Admin\TabsController::findRolByName');
$routes->post('admin/tabs/obtenerTabsRol', 'Admin\TabsController::getAllTabByRol');
$routes->post('admin/tabs/quitarTabRol', 'Admin\TabsController::deleteRolTab');
$routes->post('admin/tabs/asignarTabRol', 'Admin\TabsController::addRolTab');

