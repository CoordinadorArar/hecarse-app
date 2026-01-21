<!-- PLANTILLA BASE -->
<?php echo $this->extend('template/layout'); ?>

<!-- SECCION DE CSS -->
<?php echo $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/modulos.css">
<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE CSS -->

<!-- SECCION PRINCIPAL -->
<?php echo $this->section('contenido'); ?>

<main id="main" class="main">
    <!-- Sección de Tabs -->
    <ul class="nav nav-tabs" id="moduleManagementTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="moduleList-tab" data-bs-toggle="tab" href="#moduleList" role="tab" aria-controls="moduleList" aria-selected="true">
                Lista de Módulos
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="createModule-tab" data-bs-toggle="tab" href="#createModule" role="tab" aria-controls="createModule" aria-selected="false">
                Crear Módulo
            </a>
        </li>
    </ul>
    <!-- Contenido de los Tabs -->
    <div class="tab-content" id="moduleManagementTabs">
        <!-- Tab 1: Lista de Módulos -->
        <div class="tab-pane fade show active" id="moduleList" role="tabpanel" aria-labelledby="moduleList-tab">
            <div class="card">
                <div class="card-body">
                    <!-- Agrega un contenedor table-responsive para evitar el desbordamiento -->
                    <div class="table-responsive" id="contenedor_table">
                        <?php echo $tabla_modulos; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 2: Crear Rol -->
        <div class="tab-pane fade" id="createModule" role="tabpanel" aria-labelledby="createModule-tab">
            <div class="card">
                <div class="card-body p-4">
                    <form id="formulario_creacion">
                        <div class="row mb-4">
                            <!-- Nombre -->
                            <div class="col-6">
                                <label for="nombre_crear" class="form-label">Nombre: (*)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                    <input type="text" class="form-control shadow-sm" id="nombre_crear" placeholder="Digite el nombre del módulo" onkeypress="return noStrangeCharacters(event)">
                                </div>
                            </div>
                            <!-- Ruta -->
                            <div class="col-6">
                                <label for="ruta_crear" class="form-label">Ruta: (*)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                    <input type="text" class="form-control shadow-sm" id="ruta_crear" placeholder="Digite el ruta del módulo">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <!-- Icono -->
                             <div class="col-6">
                                <label for="icono_crear" class="form-label">Icono: (*)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                    <input type="text" class="form-control shadow-sm" id="icono_crear" placeholder="Digite el icono del módulo, ej: bi bi-gear" onkeypress="return noStrangeCharacters(event)">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <label for="selectLosetaPadre" class="form-label">Seleccionar loseta padre</label>
                                <select class="form-select" id="select_loseta_padre" onchange="obtenerModulos(this)">
                                    <option value="">Seleccionar loseta...</option>
                                    <?php foreach ($losetas as $loseta) :?>
                                        <option value="<?php echo $loseta['Id'];?>"><?php echo $loseta['Nombre'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex flex-column">
                                <label for="selectModuloPadre" class="form-label">Seleccionar módulo padre</label>
                                <select class="form-select" id="select_modulo_padre">
                                    <option value="">Seleccionar módulo...</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón de Crear Módulo -->
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary w-50 shadow-sm" id="btn_crear_modulo">Crear Módulo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL DE EDICION DE MODULO -->
    <div class="modal fade" id="editModuloModal" tabindex="-1" aria-labelledby="editModuloModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModuloModalLabel">Modificar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Custom Styled Validation -->
                    <form class="row g-3" id="formulario_editar_modulo">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                <input type="text" class="form-control" id="nombre" value="" onkeypress="return noStrangeCharacters(event)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="ruta" class="form-label">Ruta</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-link"></i></span>
                                <input type="text" class="form-control" id="ruta" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="icono" class="form-label">Icono</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-card-text"></i></span>
                                <input type="text" class="form-control" id="icono" value="" onkeyup="printIcon(this)" onkeypress="return noStrangeCharacters(event)" required>
                                <span class="input-group-text" id="IconoImage">-</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="losetaPadre" class="form-label">Loseta Padre</label>
                            <select class="form-select" id="losetaPadre">
                                <option value="">Seleccionar loseta...</option>
                                <?php foreach ($losetas as $loseta) :?>
                                    <option value="<?php echo $loseta['Id'];?>"><?php echo $loseta['Nombre'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="moduloPadre" class="form-label">Módulo Padre</label>
                            <select class="form-select" id="moduloPadre">
                                <option value="">Seleccionar módulo...</option>
                                <?php foreach ($modulos as $modulo) :?>
                                    <option value="<?php echo $modulo['Id'];?>"><?php echo $modulo['Nombre'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="invalidCheck">Activar/Inactivar</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                            </div>
                        </div>

                        <input type="hidden" id="IdModulo" value="">

                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit" id="btn_actualizar_modulo">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->
                </div>
            </div>
        </div>
    </div>
</main>

<?php echo $this->endSection(); ?>
<!-- FIN SECCION PRINCIPAL -->

<!-- SECCION DE SCRIPTS -->
<?php echo $this->section('scripts'); ?>
<script>
    /**
     * Configuración de Toast de Sweetalert.
     */
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    const renderizarTabla = () => {
        if ($.fn.DataTable.isDataTable('#tabla_modulos')) {
            $('#tabla_modulos').DataTable().destroy();
        }

        $('#tabla_modulos').DataTable({
            responsive: true,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos disponibles en la tabla",
                "thousands": ",",
                "decimal": ".",
                "infoPostFix": "",
                "aria": {
                    "sortAscending": ": activar para ordenar la columna ascendente",
                    "sortDescending": ": activar para ordenar la columna descendente"
                }
            }
        });
    }

    /**
     * 
     */
    document.addEventListener('DOMContentLoaded', function() {
        renderizarTabla();
    });

    /**Método para imprimir el icono en la vista */
    const printIcon = (input) => {
        let icono = input.value;
        $('#IconoImage').html(`<i class="bi bi-${icono}"></i>`);
    }

    /**
     * Metodo para obtener la informacion de un modulo en especifico
     * cuando se abre el modal de edicion.
     */
    const obtenerModulo = async (id) => {
        document.querySelector('#formulario_editar_modulo').reset();

        try {
            const response = await fetch(`<?= base_url() ?>admin/modulos/${id}`, {
                method: 'POST'
            });
            const result = await response.json();

            if (result.success) {
                $('#IdModulo').val(result.modulo.Id);
                $('#nombre').val(result.modulo.Nombre);
                $('#ruta').val(result.modulo.Ruta);
                let iconoDividido = result.modulo.Icono.split('-');
                let icono = '';
                for(i = 1; i < iconoDividido.length; i++) {
                    icono += iconoDividido[i];
                }
                $('#icono').val(result.modulo.Icono);

                if(result.modulo.IdLoseta != null){
                    $('#losetaPadre option[value="'+result.modulo.IdLoseta+'"]').prop('selected', true);
                }
                
                if(result.modulo.IdModulo){
                    $('#moduloPadre option[value="'+result.modulo.IdModulo+'"]').prop('selected', true);
                }

                $('#invalidCheck').prop('checked', result.modulo.FechaFinalizacion === null);
            }

        } catch (error) {
            console.log('Se ha producido un error: ', error);
        }
    }

    /**
     * Metodo para guardar la informacion actualizada del módulo.
     */
    const updateModule = async () => {
        $('#btn_actualizar_modulo').prop('disabled', true);

        let formData = new FormData();
        formData.append('Id', $('#IdModulo').val());
        formData.append('Nombre', $('#nombre').val());
        formData.append('Ruta', $('#ruta').val());
        formData.append('Icono', $('#icono').val());
        formData.append('IdLoseta', $('#losetaPadre').val());
        formData.append('IdModulo', $('#moduloPadre').val());
        formData.append('FechaFinalizacion', $('#invalidCheck').prop('checked') ? 1 : 0);

        try {
            let response = await fetch(`<?= base_url() ?>admin/modulos/actualizarModulo`, {
                method: 'POST',
                body: formData
            });

            let result = await response.text();

            $('#editModuloModal').modal('hide');

            Toast.fire({
                icon: 'success',
                title: 'Módulo actualizado correctamente.'
            });

            $('#contenedor_table').html(result);
            $('#btn_actualizar_modulo').prop('disabled', false);
            renderizarTabla();

        } catch (error) {
            console.log('Se ha producido un error: ', error);
        }
    }

    /**
     * Metodo para consultar los modulos de una loseta
     */
    const obtenerModulos = async (elemento) => {
        let idLoseta = elemento.value;

        if(idLoseta != null && idLoseta != '') {
            const formData = new FormData();
            formData.append('IdLoseta', idLoseta);

            try {
                const response = await fetch(`<?= base_url() ?>admin/modulos/obtenerModulosLoseta`, {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if(result.success){
                    let html = `<option value="">Seleccionar módulo...</option>`;

                    result.modulos.forEach(item => {
                        html += `<option value="${item.Id}">${item.Nombre}</option>`;
                    });

                    $('#select_modulo_padre').html(html);
                }
            } catch (error) {
                console.log('Se ha producido un error: ', error);
            }
        }
    }
    
    /**
     * Metodo para crear un nuevo modulo.
     */
    const crearModulo = async () => {
        $('#btn_crear_modulo').prop('disabled', true);

        const formData = new FormData();
        formData.append('Nombre', $('#nombre_crear').val());
        formData.append('Ruta', $('#ruta_crear').val());
        formData.append('Icono', $('#icono_crear').val());
        formData.append('IdLosetaPadre', $('#select_loseta_padre').val());
        formData.append('IdModuloPadre', $('#select_modulo_padre').val());

        try {
            const response = await fetch(`<?= base_url() ?>admin/modulos/crearModulo`, {
                method: 'POST',
                body: formData
            });

            const result = await response.text();

            Toast.fire({
                icon: 'success',
                title: 'Módulo creado correctamente.'
            });

            $('#formulario_creacion').trigger('reset');
            $('#contenedor_table').html(result);
            $('#btn_crear_modulo').prop('disabled', false);
            renderizarTabla();

        } catch (error) {
            console.log('Se ha producido un error: ', error);
        }
    }

    /**
     * 
     */
    document.querySelector('#formulario_creacion').addEventListener('submit', (e) => {
        e.preventDefault();
        crearModulo();
    });
    document.querySelector('#formulario_editar_modulo').addEventListener('submit', (e) => {
        e.preventDefault();
        updateModule();
    });
</script>
<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE SCRIPTS -->