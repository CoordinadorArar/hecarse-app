<?php

namespace App\Controllers\Financiero;

use App\Controllers\BaseController;
use App\Models\LosetasModel;
use App\Models\UsuariosModel;
use App\Models\FinancieroModel;

use CodeIgniter\HTTP\RedirectResponse;

class FinancieroController extends BaseController
{
    private $session;

    private $losetas_model;

    private $usuarios_model;

    private $financiero_model;

    /**
     * Metodo constructor.
     */
    function __construct()
    {
        $this->session = session();
        $this->losetas_model = new LosetasModel();
        $this->usuarios_model = new UsuariosModel();
        $this->financiero_model = new FinancieroModel();
    }

    /**
     * Metodo para renderizar la vista inicial del modulo "financiero".
     * Se prepara el nombre de usuario y la imagen de usuario para renderizarla en la vista.
     * 
     * @param string $idLoseta Identificador de la loseta.
     * @return string|RedirectResponse Vista de login.
     */
    public function index($id_loseta): string|RedirectResponse
    {
        helper('ConstruirDataVista');

        $data = construirVista($this->session->get('usu_id'), $id_loseta);

        if ($data instanceof RedirectResponse) {
            return $data;
        }

        return view('financiero/onboarding', $data);
    }

    /**
     * Módulo de informe de recaudos
     */
    public function controlFinanciero($id_loseta): string|RedirectResponse
    {
        helper('ConstruirDataVista');

        $data = construirVista($this->session->get('usu_id'), $id_loseta);

        if ($data instanceof RedirectResponse) {
            return $data;
        }

        return view('financiero/controlFinanciero', $data);
    }

    public function temporales()
    {
        $anio = $this->request->getPost('anio');
        $mes = $this->request->getPost('mes');

        if (!$anio || !$mes) {
            return $this->response->setJSON([]);
        }

        $data = $this->financiero_model->getTemporales($anio, $mes);

        return $this->response->setJSON($data);
    }


    public function empleadosSinTemporal()
    {
        $anio = $this->request->getPost('anio');
        $mes = $this->request->getPost('mes');

        $data = $this->financiero_model->getEmpleadosSinTemporal($anio, $mes);

        return $this->response->setJSON($data);
    }

    public function consultarReporte()
    {
        $anio = $this->request->getPost('anio');
        $mes = $this->request->getPost('mes');
        $temporal = $this->request->getPost('temporal');

        $data = $this->financiero_model->getReporteGeneral($anio, $mes, $temporal);

        return $this->response->setJSON($data);
    }


    public function procesarReporte()
    {
        $anio = $this->request->getGet('anio');
        $mes = $this->request->getGet('mes');
        $temporal = $this->request->getGet('temporal');

        $datos = $this->financiero_model->getReporteGeneral($anio, $mes, $temporal);

        // $this->financiero_model->guardarReporteProcesado($datos, $anio, $mes, $temporal);

    }

}
