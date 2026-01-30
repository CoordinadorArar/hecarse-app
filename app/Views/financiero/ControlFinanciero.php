<!-- PLANTILLA BASE -->
<?php echo $this->extend('template/layout'); ?>

<!-- SECCION DE CSS -->
<?php echo $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/financiero.css">
<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE CSS -->

<!-- SECCION PRINCIPAL -->
<?php echo $this->section('contenido'); ?>

<main id="main" class="main">

    <div class="tab-content" id="moduleManagementTabs">
        <div class="tab-pane fade show active" id="moduleList" role="tabpanel" aria-labelledby="moduleList-tab">
            <div class="card">
                <div class="card-body">
                    <br>

                    <div class="row mb-4">
                        <p>Período a consultar</p>
                        <div class="col-4">
                            <label for="descripcion" class="form-label">Año:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                <select class="form-select shadow-sm" id="anio">
                                    <option value="" disabled selected>Seleccione el año</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="descripcion" class="form-label">Mes:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                <select class="form-select shadow-sm" id="mes">
                                    <option value="" disabled selected>Seleccione el mes</option>
                                    <option value="01"> Enero </option>
                                    <option value="02"> Febrero </option>
                                    <option value="03"> Marzo </option>
                                    <option value="04"> Abril </option>
                                    <option value="05"> Mayo </option>
                                    <option value="06"> Junio </option>
                                    <option value="07"> Julio </option>
                                    <option value="08"> Agosto </option>
                                    <option value="09"> Septiembre </option>
                                    <option value="10"> Octubre </option>
                                    <option value="11"> Noviembre </option>
                                    <option value="12"> Diciembre </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="temporal" class="form-label">Temporal:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <select class="form-select shadow-sm" id="temporal">
                                    <option value="" disabled selected>Seleccione la temporal</option>

                                </select>
                            </div>
                        </div>
                    </div>


                    <br>
                    <button type="button" class="btn btn-primary" id="guardar-referencia-siesa">Consultar</button>

                    <!-- Modal empleados sin temporal -->
                    <div class="modal fade" id="modalSinTemporal" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Lista de empleados sin temporal asignada</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <table id="tabla-sin-temporal" class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Empleado</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card mt-3">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-tabs-bordered px-3 pt-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="reporteTotal-tab" data-bs-toggle="tab" href="#reporteTotal"
                        role="tab" aria-controls="reporteTotal" aria-selected="true">
                        Reporte Total
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reporteDetalladoLabor-tab" data-bs-toggle="tab"
                        href="#reporteDetalladoLabor" role="tab" aria-controls="reporteDetalladoLabor"
                        aria-selected="false">
                        Reporte Detallado por Labor
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reporteDetalladoTotal-tab" data-bs-toggle="tab"
                        href="#reporteDetalladoTotal" role="tab" aria-controls="reporteDetalladoTotal"
                        aria-selected="false">
                        Reporte Detallado Total
                    </a>
                </li>
            </ul>

            <div class="tab-content p-3">

                <div class="tab-pane fade show active" id="reporteTotal">
                    <table id="tabla-total" class="table table-striped w-100"></table>
                    <div class="text-end mt-3">
                        <button class="btn btn-success d-none" id="btnProcesar">
                            <i class="bi bi-file-earmark-excel"></i> Procesar
                        </button>
                    </div>
                </div>

                <div class="tab-pane fade" id="reporteDetalladoLabor">
                    <table id="tabla-labor" class="table table-striped w-100"></table>
                </div>

                <div class="tab-pane fade" id="reporteDetalladoTotal">
                    <table id="tabla-detallado" class="table table-striped w-100"></table>
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

    let InconsistenciasTemporal = false;

    document.addEventListener('DOMContentLoaded', () => {
        cargarAnios();

        $('#anio, #mes').on('change', cargarTemporales);
        $('#guardar-referencia-siesa').on('click', consultarReporte);
    });

    function cargarAnios() {
        const anioActual = new Date().getFullYear();
        let html = '<option disabled selected>Seleccione el año</option>';

        for (let i = 0; i <= 2; i++) {
            html += `<option value="${anioActual - i}">${anioActual - i}</option>`;
        }

        $('#anio').html(html);
    }

    function cargarTemporales() {
        const anio = $('#anio').val();
        const mes = $('#mes').val();
        const select = $('#temporal');

        if (!anio || !mes) return;

        select.prop('disabled', true);
        select.html('<option>Cargando...</option>');

        InconsistenciasTemporal = false;
        $('#btnProcesar').hide();

        fetch("<?= base_url('financiero/temporales') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `anio=${anio}&mes=${mes}`
        })
            .then(res => res.json())
            .then(data => {
                select.html('<option disabled selected>Seleccione la temporal</option>');

                let temporalesValidas = 0;

                data.forEach(item => {
                    if (!item.RazonTemporal || item.RazonTemporal.trim() === '') {
                        InconsistenciasTemporal = true;
                    } else {
                        temporalesValidas++;
                        select.append(`
                        <option value="${item.RazonTemporal}">
                            ${item.RazonTemporal}
                        </option>
                    `);
                    }
                });

                select.prop('disabled', false);

                if (InconsistenciasTemporal) {
                    mostrarAlertaInconsistencias();
                } else if (temporalesValidas > 0) {
                    $('#btnProcesar').show();
                }
            })
            .catch(() => select.prop('disabled', false));
    }


    function mostrarAlertaInconsistencias() {
        Swal.fire({
            icon: 'error',
            title: 'Inconsistencias detectadas',
            html: `
            <p>Existen empleados <b>sin temporal asignada</b>.</p>
            <p>No es posible descargar el Excel hasta corregir estas inconsistencias.</p>
        `,
            confirmButtonText: 'Ver empleados'
        }).then(result => {
            if (result.isConfirmed) {
                cargarEmpleadosSinTemporal();
            }
        });
    }

    let dataGlobal = [];

    function consultarReporte() {
        const anio = $('#anio').val();
        const mes = $('#mes').val();
        const temporal = $('#temporal').val();

        if (!anio || !mes || !temporal) {
            Swal.fire('Atención', 'Seleccione año, mes y temporal', 'warning');
            return;
        }

        bloquearUI(true);

        $.post("<?= base_url('financiero/consultar-reporte') ?>", {
            anio, mes, temporal
        }, response => {

            dataGlobal = response;

            cargarReporteTotal();
            cargarReporteLabor();
            cargarReporteDetallado();

            bloquearUI(false);
        });

        if (!InconsistenciasTemporal) {
            $('#btnProcesar').removeClass('d-none');
        } else {
            $('#btnProcesar').addClass('d-none');
        }
    }

    function agruparPorEmpleado(data) {
        const agrupado = {};

        data.forEach(item => {
            const key = item.nombreTercero;

            if (!agrupado[key]) {
                agrupado[key] = {
                    cedula: item.cedula,
                    nombreTercero: item.nombreTercero,
                    RazonTemporal: item.RazonTemporal,
                    valorTotalTercero: 0,
                    fecha: item.fecha
                };
            }

            agrupado[key].valorTotalTercero += parseFloat(item.valorTotalTercero);
        });

        return Object.values(agrupado);
    }


    function agruparPorLabor(data) {
        const agrupado = {};

        data.forEach(item => {
            const key = item.nombreGrupoLabor + '_' + item.cedula;

            if (!agrupado[key]) {
                agrupado[key] = {
                    labor: item.nombreGrupoLabor,
                    cedula: item.cedula,
                    nombreTercero: item.nombreTercero,
                    RazonTemporal: item.RazonTemporal,
                    valorTotalTercero: 0
                };
            }

            agrupado[key].valorTotalTercero += parseFloat(item.valorTotalTercero);
        });

        return Object.values(agrupado);
    }


    function cargarReporteTotal() {
        const dataAgrupada = agruparPorEmpleado(dataGlobal);

        if ($.fn.DataTable.isDataTable('#tabla-total')) {
            $('#tabla-total').DataTable().destroy();
        }

        $('#tabla-total').DataTable({
            data: dataAgrupada,
            columns: [
                { title: 'Cédula', data: 'cedula' },
                { title: 'Empleado', data: 'nombreTercero' },
                { title: 'Temporal', data: 'RazonTemporal' },
                {
                    title: 'Total Pagado',
                    data: 'valorTotalTercero',
                    render: $.fn.dataTable.render.number('.', ',', 0, '$')
                },
                {
                    title: 'Fecha',
                    data: 'fecha',
                    render: function (data) {
                        return formatearFechaYYYYMMDD(data);
                    }
                },
            ],
            responsive: true,
            pageLength: 10,
            language: idiomaDataTable
        });
    }


    function cargarReporteLabor() {
        const dataLabor = agruparPorLabor(dataGlobal);

        if ($.fn.DataTable.isDataTable('#tabla-labor')) {
            $('#tabla-labor').DataTable().destroy();
        }

        $('#tabla-labor').DataTable({
            data: dataLabor,
            columns: [
                { title: 'Grupo Labor', data: 'labor' },
                { title: 'Cédula', data: 'cedula' },
                { title: 'Empleado', data: 'nombreTercero' },
                { title: 'Temporal', data: 'RazonTemporal' },
                {
                    title: 'Total Pagado',
                    data: 'valorTotalTercero',
                    render: $.fn.dataTable.render.number('.', ',', 0, '$')
                },
            ],
            responsive: true,
            pageLength: 10,
            language: idiomaDataTable
        });
    }

    // function cargarReporteDetallado() {
    //     crearTabla('#tabla-detallado', [
    //         { title: 'Cédula', data: 'cedula' },
    //         { title: 'Empleado', data: 'nombreTercero' },
    //         { title: 'Temporal', data: 'RazonTemporal' },
    //         { title: 'Concepto', data: 'nombreConcepto' },
    //         { title: 'Grupo Labor', data: 'nombreGrupoLabor' },
    //         { title: 'Centro Operación', data: 'centroOperacion' },
    //         { title: 'Centro Costos', data: 'ccosto' },
    //         { title: 'Unidad Negocio', data: 'uNegocio' },
    //         { title: 'Valor', data: 'valorTotalTercero' },
    //         { title: 'Fecha', data: 'fecha' }
    //     ]);
    // }


    function prepararReporteDetallado(data) {
        const agrupado = {};

        data.forEach(item => {
            const key = [
                item.nombreTercero,
                item.nombreGrupoLabor,
                item.ccosto
            ].join('|');

            if (!agrupado[key]) {
                agrupado[key] = {
                    nombreTercero: item.nombreTercero,
                    labor: item.nombreGrupoLabor,
                    uNegocio: item.uNegocio,
                    centroOperacion: item.centroOperacion,
                    ccosto: item.ccosto ?? '(vacío)',
                    valor: 0
                };
            }

            agrupado[key].valor += Number(item.valorTotalTercero);
        });

        return Object.values(agrupado);
    }

    let tablaDetallado = null;

    function cargarReporteDetallado() {
        const dataPreparada = prepararReporteDetallado(dataGlobal);

        const empleadosUnicos = [...new Set(
            dataPreparada.map(d => d.nombreTercero)
        )];

        colapsados = {};
        dataPreparada.forEach(r => {
            colapsados[r.nombreTercero] = empleadosUnicos.length > 1;
        });

        if (tablaDetallado) {
            tablaDetallado.destroy();
            $('#tabla-detallado tbody').off('click');
        }

        tablaDetallado = $('#tabla-detallado').DataTable({
            data: dataPreparada,
            paging: false,
            info: false,

            columns: [
                { data: 'nombreTercero', visible: false },
                { data: 'labor', title: 'Labor' },
                { data: 'uNegocio', title: 'Unidad Negocio' },
                { data: 'centroOperacion', title: 'Centro Operación' },
                { data: 'ccosto', title: 'Centro Costo' },
                {
                    data: 'valor',
                    title: 'Valor',
                    render: $.fn.dataTable.render.number('.', ',', 0, '$')
                }
            ],

            order: [[0, 'asc'], [1, 'asc']],
            language: idiomaDataTable,

            rowGroup: {
                dataSrc: 'nombreTercero',
                startRender: function (rows, group) {
                    const total = rows
                        .data()
                        .pluck('valor')
                        .reduce((a, b) => a + Number(b), 0);

                    return `
                    <tr class="grupo-empleado" data-group="${group}">
                        <td colspan="6" style="cursor:pointer;font-weight:600">
                            ${colapsados[group] ? '▶ ' : '▼ '}
                            ${group}
                            <span class="text-muted ms-2">
                                Total: $${total.toLocaleString('es-CO')}
                            </span>
                        </td>
                    </tr>
                `;
                }
            },

            drawCallback: function () {
                const api = this.api();
                api.rows().every(function () {
                    const empleado = this.data().nombreTercero;
                    $(this.node()).toggle(!colapsados[empleado]);
                });
            }
        });

        $('#tabla-detallado tbody').on('click', 'tr.grupo-empleado', function () {
            const group = $(this).data('group');
            colapsados[group] = !colapsados[group];
            tablaDetallado.draw(false);
        });
    }

    const idiomaDataTable = {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron registros",
        info: "Mostrando _START_ a _END_ de _TOTAL_",
        infoEmpty: "No hay registros disponibles",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        emptyTable: "No hay datos disponibles",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "›",
            previous: "‹"
        }
    };

    function crearTabla(id, columnas) {
        if ($.fn.DataTable.isDataTable(id)) {
            $(id).DataTable().destroy();
        }

        $(id).DataTable({
            data: dataGlobal,
            columns: columnas,
            responsive: true,
            pageLength: 10,
            language: idiomaDataTable
        });
    }

    function cargarEmpleadosSinTemporal() {
        $('#modalSinTemporal').modal('show');

        if ($.fn.DataTable.isDataTable('#tabla-sin-temporal')) {
            $('#tabla-sin-temporal').DataTable().destroy();
        }

        $('#tabla-sin-temporal').DataTable({
            ajax: {
                url: "<?= base_url('financiero/empleadosSinTemporal') ?>",
                type: "POST",
                data: {
                    anio: $('#anio').val(),
                    mes: $('#mes').val()
                },
                dataSrc: ''
            },
            columns: [
                { data: 'cedula', title: 'Documento' },
                { data: 'nombreTercero', title: 'Empleado' }
            ],
            responsive: true
        });
    }

    function bloquearUI(estado) {
        $('#guardar-referencia-siesa').prop('disabled', estado);
        $('#anio, #mes, #temporal').prop('disabled', estado);

        if (estado) {
            Swal.fire({ title: 'Consultando...', allowOutsideClick: false });
            Swal.showLoading();
        } else {
            Swal.close();
        }
    }

    function formatearFechaYYYYMMDD(fecha) {
        if (!fecha) return '';

        const str = fecha.toString();
        const anio = str.substring(0, 4);
        const mes = str.substring(4, 6);
        const dia = str.substring(6, 8);

        return `${dia}/${mes}/${anio}`;
    }


    $('#btnProcesar').on('click', function () {

        const tabla = $('#tabla-total').DataTable();

        if (tabla.data().count() === 0) {
            Swal.fire('Atención', 'No hay datos para procesar', 'warning');
            return;
        }

        exportarTablaExcel('#tabla-total', 'REPORTE');

        // guardar en BD
        // guardarReporteBD();
    });


    function exportarTablaExcel(idTabla, nombreArchivo) {
        const tabla = document.querySelector(idTabla);
        const anio = $('#anio').val();
        const mes = $('#mes').val();
        const temporal = $('#temporal').val();

        if (!tabla) {
            Swal.fire('Error', 'No hay información para exportar', 'error');
            return;
        }

        let tablaHTML = tabla.outerHTML.replace(/ /g, '%20');

        const fecha = new Date().toISOString().slice(0, 19).replace(/:/g, '-');
        const filename = `${nombreArchivo}-${temporal}-${anio}-${mes}.xls`;

        let a = document.createElement('a');
        a.href = 'data:application/vnd.ms-excel;charset=utf-8,' + tablaHTML;
        a.download = filename;

        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }



    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
        $.fn.dataTable
            .tables({ visible: true, api: true })
            .columns.adjust()
            .responsive.recalc();
    });

</script>

<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE SCRIPTS -->