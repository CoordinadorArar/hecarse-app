<?php

namespace App\Controllers\Dashboards;

use App\Controllers\BaseController;
use App\Models\LosetasModel;
use App\Models\ReportesPowerBiModel;
use App\Models\UsuariosModel;

use CodeIgniter\HTTP\RedirectResponse;

class DashboardsController extends BaseController
{
    private $session;

    private $losetas_model;

    private $reportes_power_bi_model;

    private $usuarios_model;

    /**
     * Metodo constructor.
     */
    function __construct()
    {
        $this->session = session();
        $this->losetas_model = new LosetasModel();
        $this->reportes_power_bi_model = new ReportesPowerBiModel();
        $this->usuarios_model = new UsuariosModel();
    }

    /**
     * Metodo para renderizar la vista inicial del modulo "comercial".
     * Se prepara el nombre de usuario y la imagen de usuario para renderizarla en la vista.
     * 
     * @param string $idLoseta Identificador de la loseta.
     * @return string|RedirectResponse Vista de login.
     */
    public function index($id_loseta): string|RedirectResponse
    {
        helper('ConstruirDataVista');

        $data = construirVista($this->session->get('usu_id'), $id_loseta);

        $reportes = $this->reportes_power_bi_model->obtenerListaReportes();
        $reportesUsuario = [];

        foreach ($reportes as $reporte) {
            foreach (json_decode($reporte['Usuarios']) as $usuario_asignado) {
                if ($usuario_asignado->id == $data['usuario']['Documento']) {
                    $reportesUsuario[] = $reporte;
                }
            }
        }

        $data['reportes_usuario'] = $reportesUsuario;

        return view('dashboards/onboarding', $data);
    }
}
