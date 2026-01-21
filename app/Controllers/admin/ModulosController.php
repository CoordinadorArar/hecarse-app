<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\LosetasModel;

class ModulosController extends BaseController
{
    private $session;

    private $losetas_model;

    /**
     * Metodo constructor.
     */
    function __construct()
    {
        $this->session = session();
        $this->losetas_model = new LosetasModel();
    }

    /**
     * Metodo para renderizar la vista de todos los modulos.
     * 
     * @param string $idLoseta Identificador de la loseta.
     * @return string|RedirectResponse Vista de los modulos.
     */
    public function index($id_loseta): string|RedirectResponse
    {
        helper('ConstruirDataVista');

        $data = construirVista($this->session->get('usu_id'),$id_loseta);

        if ($data instanceof RedirectResponse) {
            return $data;
        }

        $tabla_modulos = $this->renderizarListaModulos();

        $data['tabla_modulos'] = $tabla_modulos;
        $data['losetas'] = $this->losetas_model->getAllModules(['IdLoseta IS NULL']);
        $data['modulos'] = $this->losetas_model->getAllModules(['IdLoseta IS NOT NULL', 'IdModulo IS NOT NULL']);
             
        return view('admin/modulos', $data);
    }

    private function renderizarListaModulos(): string
    {
        $modulos = $this->losetas_model->getAllModules();

        $html = '<table id="tabla_modulos" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ruta</th>
                        <th>Icono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>';

        $html .= '<tbody>';

        foreach ($modulos as $modulo) {
            $estado = is_null($modulo['FechaFinalizacion']) ? 'activo' : 'inactivo';
            $html .= '<tr class="' . $estado . '">
                    <td>' . htmlspecialchars($modulo['Nombre']) . '</td>
                    <td>' . htmlspecialchars($modulo['Ruta']) . '</td>
                    <td>' . htmlspecialchars($modulo['Icono']) . ' - <i class="text-primary '.$modulo['Icono'].'"></i></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModuloModal" onclick="obtenerModulo(' . $modulo['Id'] . ')">Modificar</button>
                    </td>
                </tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        return $html;
    }

    /**
     * Metodo para obtener la informacion de un modulo en especifico.
     * 
     * @param int $id Identificador del modulo.
     * @return ResponseInterface Informacion del modulo formato JSON
     */
    public function getModuleById(int $id): ResponseInterface
    {
        $modulo =  $this->losetas_model->getModuleById($id);
        return $this->response->setJSON(['success' => true, 'modulo' => $modulo]);
    }

    /**
     * Metodo para gestionar la creacion de un modulo nuevo.
     * 
     * @return ResponseInterface Resultado de la operacion.
     */
    public function createModule(): ResponseInterface
    {
        $id_loseta = (!empty($this->request->getVar('IdLosetaPadre')))? $this->request->getVar('IdLosetaPadre') : NULL;
        $id_modulo = (!empty($this->request->getVar('IdModuloPadre')))? $this->request->getVar('IdModuloPadre') : NULL;
        $data = [
            'Nombre' => $this->request->getVar('Nombre'),
            'Ruta' => $this->request->getVar('Ruta'),
            'Icono' => $this->request->getVar('Icono'),
            'IdLoseta' => $id_loseta,
            'IdModulo' => $id_modulo,
            'IdUsuario' => $this->session->get('usu_id')
        ];

        $this->losetas_model->createModule($data);
        $table = $this->renderizarListaModulos();
        return $this->response->setBody($table);
    }

    /**
     * Metodo para consultar los modulos por el id de la loseta
     */
    public function getModulesByLosetaId(): ResponseInterface
    {
        $id_loseta = $this->request->getVar('IdLoseta');

        $data = array();
        $data[] = ['IdLoseta', '=', $id_loseta];
        array_push($data, 'IdModulo IS NULL');

        $modulos = $this->losetas_model->getAllModules($data);
        return $this->response->setJSON(['success' => true,'modulos' => $modulos]);
    }

    /**
     * Metodo para actualizar un modulo.
     */
    public function updateModule(): ResponseInterface
    {
        $date = date('Y-m-d H:i:s');
        $fecha = explode(' ', $date)[0] . 'T' . explode(' ', $date)[1];

        $data = [
            'Nombre' => $this->request->getVar('Nombre'),
            'Ruta' => $this->request->getVar('Ruta'),
            'Icono' => $this->request->getVar('Icono'),
            'FechaModificacion' => $fecha,
            'FechaFinalizacion' => $this->request->getVar('FechaFinalizacion') == 0 ? $fecha : null
        ];
        if(!empty($this->request->getVar('IdLoseta')) && $this->request->getVar('IdLoseta') != ''){
            $data['IdLoseta'] = $this->request->getVar('IdLoseta');
        }

        if(!empty($this->request->getVar('IdModulo')) && $this->request->getVar('IdModulo') != ''){
            $data['IdModulo'] = $this->request->getVar('IdModulo');
        }

        $this->losetas_model->updateModule($this->request->getVar('Id'), $data);
        $table = $this->renderizarListaModulos();
        return $this->response->setBody($table);
    }
}
