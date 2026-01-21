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
$routes->post('admin/admin/marcas', 'Admin\AdminController::getMarcas');
$routes->post('admin/admin/proveedores', 'Admin\AdminController::getProveedores');
$routes->post('admin/admin/obtenerCentrosOperaciones', 'Admin\AdminController::getCentrosOperaciones');
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

/** Rutas de la loseta de  "Comercial".*/
$routes->get('comercial/onboarding/(:num)', 'Comercial\ComercialController::index/$1');

/** Rutas lista de precios */
$routes->get('comercial/listaPrecios/(:num)', 'Comercial\ListaController::index/$1');
$routes->get('comercial/adminListaPrecios/(:num)', 'Comercial\ListaController::adminListaPrecios/$1');
$routes->post('comercial/adminListaPrecios/actualizarPrecios', 'Comercial\ListaController::updatePrices');
$routes->post('comercial/adminListaPrecios/obtenerDisponibilidadItem', 'Comercial\ListaController::obtenerDisponibilidad');
$routes->post('comercial/lista/obtenerDetallesPorReferencia', 'Comercial\ListaController::obtenerDetalles');

/** Rutas de reportes Power BI */
$routes->get('comercial/reportesPowerBi/(:num)', 'Comercial\ReportesPowerBiController::index/$1');
$routes->get('comercial/adminReportesPowerBi/(:num)', 'Comercial\ReportesPowerBiController::adminReportes/$1');
$routes->get('comercial/listaUsuarios', 'Comercial\ReportesPowerBiController::getActivedUsers');
$routes->post('comercial/reportesPowerBi/crearReporte', 'Comercial\ReportesPowerBiController::createReporte');
$routes->post('comercial/reportesPowerBi/(:num)', 'Comercial\ReportesPowerBiController::getReporteById/$1');
$routes->post('comercial/reportesPowerBi/asignarUsuarios', 'Comercial\ReportesPowerBiController::asignarUsuarios');
$routes->post('comercial/reportesPowerBi/actualizarReporte', 'Comercial\ReportesPowerBiController::updateReporte');
$routes->post('comercial/reportesPowerBi/eliminarReporte', 'Comercial\ReportesPowerBiController::deleteReporte');

/** Rutas de precodificaciones */
$routes->get('comercial/precodificaciones/(:num)', 'Comercial\PrecodificacionesController::index/$1');
$routes->get('comercial/precodificaciones/obtenerSubcategorias/(:any)', 'Comercial\PrecodificacionesController::obtenerSubcategorias/$1');
$routes->get('comercial/precodificaciones/obtenerLineas/(:any)', 'Comercial\PrecodificacionesController::obtenerLineas/$1');
$routes->get('comercial/precodificaciones/obtenerSublineas/(:any)', 'Comercial\PrecodificacionesController::obtenerSublineas/$1');
$routes->get('comercial/precodificaciones/obtenerNombreSubCategoria/(:any)', 'Comercial\PrecodificacionesController::obtenerNombreSubCategoria/$1');
$routes->get('comercial/precodificaciones/obtenerNombreLinea/(:any)', 'Comercial\PrecodificacionesController::obtenerNombreLinea/$1');
$routes->get('comercial/precodificaciones/obtenerNombreSubLinea/(:any)', 'Comercial\PrecodificacionesController::obtenerNombreSubLinea/$1');
$routes->get('comercial/precodificaciones/obtenerOpciones/(:any)', 'Comercial\PrecodificacionesController::obtenerOpciones/$1');
$routes->get('comercial/precodificaciones/obtenerEspecificacionesPorLinea/(:any)', 'Comercial\PrecodificacionesController::obtenerEspecificacionesPorLinea/$1');
$routes->post('comercial/precodificaciones/crearPrecodificacion', 'Comercial\PrecodificacionesController::createPrecodificacion');
$routes->post('comercial/precodificaciones/(:num)', 'Comercial\PrecodificacionesController::getPrecodificacionById/$1');
$routes->post('comercial/precodificaciones/(:num)', 'Comercial\PrecodificacionesController::getMedidaById/$1');
$routes->post('comercial/precodificaciones/actualizarPrecodificacion', 'Comercial\PrecodificacionesController::updatePrecodificacion');
$routes->post('comercial/precodificaciones/eliminarPrecodificacion/(:num)', 'Comercial\PrecodificacionesController::deletePrecodificacion/$1');
$routes->post('comercial/precodificaciones/crearEspecificacion', 'Comercial\PrecodificacionesController::createEspecificacion');
$routes->post('comercial/precodificaciones/actualizarEspecificacion', 'Comercial\PrecodificacionesController::actualizarEspecificacion');
$routes->post('comercial/precodificaciones/verificarReferenciaSiesa', 'Comercial\PrecodificacionesController::verificarReferenciaSiesa');
$routes->post('comercial/precodificaciones/obtenerDatosTabla', 'Comercial\PrecodificacionesController::obtenerDatosTabla');
$routes->post('comercial/precodificaciones/crearSolicitud', 'Comercial\PrecodificacionesController::createSolicitud');
$routes->post('comercial/precodificaciones/obtenerSolicitudes', 'Comercial\PrecodificacionesController::obtenerSolicitudes');
$routes->post('comercial/precodificaciones/actualizarSolicitud', 'Comercial\PrecodificacionesController::actualizarSolicitud');

/** Rutas de marcación por zebra */
$routes->get('comercial/marcacionZebra/(:num)', 'Comercial\MarcacionZebraController::index/$1');
$routes->get('comercial/fichaFormato', 'Comercial\MarcacionZebraController::fichaformato');
$routes->post('comercial/marcacionZebra/consultaMaterial', 'Comercial\MarcacionZebraController::getProductByMaterial');
$routes->post('comercial/marcacionZebra/consultarAliados', 'Comercial\MarcacionZebraController::getAliados');

/** Rutas de la loseta de  "Soporte".*/
$routes->get('soporte/onboarding/(:num)', 'Soporte\SoporteController::index/$1');
/** Rutas SISC */
$routes->get('soporte/sisc/(:num)', 'Soporte\ServicioAlClienteController::index/$1'); /**Esta ruta no es accesible, ya que SISC es una opción desplegable que contiene más opciones */
$routes->get('soporte/sisc/gestionCasos/(:num)', 'Soporte\ServicioAlClienteController::index/$1');
$routes->get('soporte/sisc/reportes/(:num)', 'Soporte\ServicioAlClienteController::reportes/$1');
$routes->get('soporte/sisc/administracion/(:num)', 'Soporte\ServicioAlClienteController::administracion/$1');
$routes->post('soporte/sisc/crearTipoCaso', 'Soporte\ServicioAlClienteController::createTipoCaso');
$routes->post('soporte/sisc/tiposCasos/(:num)', 'Soporte\ServicioAlClienteController::getTipoCasoById/$1');
$routes->post('soporte/sisc/actualizarTipoCaso', 'Soporte\ServicioAlClienteController::updateTipoCaso');
$routes->post('soporte/sisc/crearEstadoCaso', 'Soporte\ServicioAlClienteController::createEstadoCaso');
$routes->post('soporte/sisc/estadosCasos/(:num)', 'Soporte\ServicioAlClienteController::getEstadoCasoById/$1');
$routes->post('soporte/sisc/actualizarEstadoCaso', 'Soporte\ServicioAlClienteController::updateEstadoCaso');
$routes->post('soporte/sisc/crearMotivoCierreCaso', 'Soporte\ServicioAlClienteController::createMotivoCierreCaso');
$routes->post('soporte/sisc/motivosCierreCasos/(:num)', 'Soporte\ServicioAlClienteController::getMotivoCierreCasoById/$1');
$routes->post('soporte/sisc/actualizarMotivoCierreCaso', 'Soporte\ServicioAlClienteController::updateMotivoCierreCaso');
$routes->post('soporte/sisc/crearPuntoServicio', 'Soporte\ServicioAlClienteController::createPuntoServicio');
$routes->post('soporte/sisc/puntosServicio/(:num)', 'Soporte\ServicioAlClienteController::getPuntoServicioById/$1');
$routes->post('soporte/sisc/actualizarPuntoServicio', 'Soporte\ServicioAlClienteController::updatePuntoServicio');
$routes->post('soporte/sisc/obtenerInfoCliente', 'Soporte\ServicioAlClienteController::getInfoClient');
$routes->post('soporte/sisc/crearCaso', 'Soporte\ServicioAlClienteController::createCaso');
$routes->post('soporte/sisc/consultaCaso', 'Soporte\ServicioAlClienteController::getCasoById');
$routes->post('soporte/sisc/trasladarCaso', 'Soporte\ServicioAlClienteController::trasladarCaso');
$routes->post('soporte/sisc/consultarCasoNoCerrado', 'Soporte\ServicioAlClienteController::getCasoNoCerrado');
$routes->post('soporte/sisc/obtenerEstadosCasos', 'Soporte\ServicioAlClienteController::getEstadosCasos');
$routes->post('soporte/sisc/obtenerMotivosCierreCasos', 'Soporte\ServicioAlClienteController::getMotivosCierreCasos');
$routes->post('soporte/sisc/consultarHistorialCaso', 'Soporte\ServicioAlClienteController::getHistorialCaso');
$routes->post('soporte/sisc/actualizarCaso', 'Soporte\ServicioAlClienteController::updateCaso');
$routes->post('soporte/sisc/cerrarCaso', 'Soporte\ServicioAlClienteController::cerrarCaso');
$routes->post('soporte/sisc/consultaPqrs', 'Soporte\ServicioAlClienteController::getPqrsById');
$routes->post('soporte/sisc/consultarHistorialPqrs', 'Soporte\ServicioAlClienteController::getHistorialPqrs');

/** Rutas view Productividad */
$routes->get('comercial/productividad/(:num)', 'Comercial\ProductividadController::index/$1');
$routes->post('comercial/productividad/obtenerVendedores', 'Comercial\ProductividadController::consultarVendedores');
$routes->post('comercial/productividad/generarCartaVendedor', 'Comercial\ProductividadController::generarCartaVendedor');
$routes->post('comercial/productividad/obtenerCartasVendedor', 'Comercial\ProductividadController::obtenerCartasVendedor');
