<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LosetasModel;
use App\Models\AdminModel;
use App\Models\PrecodificacionesModel;
use CodeIgniter\HTTP\RedirectResponse;

use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    private $session;

    private $losetas_model;

    private $admin_model;

    private $precodificaciones_model;

    /**
     * Metodo constructor.
     */
    function __construct()
    {
        $this->session = session();
        $this->losetas_model = new LosetasModel();
        $this->admin_model = new AdminModel();
        $this->precodificaciones_model = new PrecodificacionesModel();
    }

    /**
     * Metodo para renderizar la vista inicial del modulo "administracion".
     * Se prepara el nombre de usuario y la imagen de usuario para renderizarla en la vista.
     * 
     * @param string $idLoseta Identificador de la loseta.
     * @return string|RedirectResponse Vista de login.
     */
    public function index($id_loseta): string|RedirectResponse
    {
        helper('ConstruirDataVista');

        $data = construirVista($this->session->get('usu_id'),$id_loseta);

        if ($data instanceof RedirectResponse) {
            return $data;
        }

        return view('admin/onboarding', $data);
    }

    /**
     * Metodo para consultar departamentos
     */
    public function getDepartamentos(): ResponseInterface
    {
        $departamentos = $this->admin_model->getDepartamentos();

        return $this->response->setJSON(['success' => true, 'departamentos' => $departamentos]);
    }

    /**
     * Metodo para consultar ciudades
     */
    public function getCiudades(): ResponseInterface
    {

        $id_departamento = $this->request->getVar('idDepartamento');

        $ciudades = $this->admin_model->getCiudades($id_departamento);

        return $this->response->setJSON(['success' => true, 'ciudades' => $ciudades]);
    }

    /**
     * Metodo para consultar marcas
     */
    public function getMarcas(): ResponseInterface
    {
        $marcas = $this->precodificaciones_model->getMarcas();

        return $this->response->setJSON(['success' => true,'marcas' => $marcas]);
    }

    /**
     * Metodo para consultar proveedores
     */
    public function getProveedores(): ResponseInterface
    {
        $proveedores = $this->precodificaciones_model->getProveedores();

        return $this->response->setJSON(['success' => true,'proveedores' => $proveedores]);
    }

    /**
     * Metodo para consultar los centros de operaciones
     */
    public function getCentrosOperaciones(): ResponseInterface
    {
        $centros_operaciones = $this->admin_model->getCentrosOperaciones();

        return $this->response->setJSON(['success' => true, 'centros_operaciones' => $centros_operaciones]);
    }

    /**
     * Metodo que muestra documentos del sistema o de rex, recibe el nombre del documento
     */
    public function getDocumentos($nombre_documento)
    {
        $data = array(
            'title' => 'Documentos Rex',
            'archivo' => $nombre_documento
        );
        return view('admin/documentos', $data);
    }
}
