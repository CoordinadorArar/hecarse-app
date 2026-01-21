<!-- PLANTILLA BASE -->
<?php echo $this->extend('template/layout'); ?>

<!-- SECCION DE CSS -->
<?php echo $this->section('css'); ?>
<link rel="stylesheet" href="public/assets/css/losetas.css">
<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE CSS -->

<!-- SECCION PRINCIPAL -->
<?php echo $this->section('contenido'); ?>

<main>
    <div class="px-4 py-1 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="public/assets/img/logo_fondo_oscuro.png" alt="Distrirex" width="300">
        <h1 class="display-5 fw-bold"><?= $title ?></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?= $subtitle ?></p>
        </div>
    </div>

    <div class="row row-cols-1 mb-3 text-center d-flex justify-content-center" id="losetas">
        <?php foreach ($losetas as $loseta): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 px-5">
                <div class="card mb-4 rounded-3 shadow-sm border-primary card-animated background-card" onclick="ingresarModulo('<?= esc($loseta['Ruta']) ?>')">
                    <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal"><?= esc($loseta['Nombre']) ?></h4>
                    </div>
                    <div class="card-body">
                        <i class="<?= esc($loseta['Icono']) ?>" style="font-size: 100px;"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mb-3">
        <button class="btn btn-secondary btn-logout" data-bs-toggle="tooltip" data-bs-title="Cerrar Sesión">
            <i class="bi bi-power"></i>
        </button>
    </div>
</main>

<?php echo $this->endSection(); ?>
<!-- FIN SECCION PRINCIPAL -->

<!-- SECCION DE SCRIPTS -->
<?php echo $this->section('scripts'); ?>
<script>
    /**
     * Metodo para redireccionar a la ruta del modulo seleccionado.
     * 
     * @param {string} ruta Ruta del modulo seleccionado.
     */
    const ingresarModulo = (ruta) => {
        window.location.href = ruta;
    }

    /**
     * Lóogica de cierre de sesión en la vista de losetas
     */
    document.querySelector('.btn-logout').addEventListener('click', () => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Estás a punto de cerrar tu sesión',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión'
        }).then(async(result) => {
            if (result.isConfirmed) {
                const response = await fetch('<?= base_url() . 'cerrar_sesion' ?>', {method: 'POST'});

                const result = await response.json();

                if (result.success) {
                    window.location.href = '<?= base_url() ?>';
                }
            }
        });
    });
</script>
<?php echo $this->endSection(); ?>
<!-- FIN SECCION DE SCRIPTS -->