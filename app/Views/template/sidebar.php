<?php
$uri = service('uri');
$url_actual = $uri->getSegment(1) . '/' . $uri->getSegment(2) . '/' . $uri->getSegment(3);
?>

<?php echo $this->section('sidebar'); ?>

<aside id="sidebar" class="sidebar">

    <div class="card mb-4 rounded-3 shadow-sm text-center">
        <div class="card-header py-3 bg-primary text-white">
            <h4 class="my-0 fw-normal" id="nombreModulo"><?= $nombre_loseta ?></h4>
        </div>
        <div class="card-body">
            <img src="<?= $imagen_usuario ?>" alt="Usuario Distribuidora Rex" class="rounded-circle my-3 imagen_usuario" width="100">
            <a type="button" class="w-100 btn btn-lg btn-outline-primary" href="<?= base_url('losetas') ?>">
                <i class="bi bi-grid-3x3-gap"></i>
                Menú Principal
            </a>
        </div>
    </div>

    <!-- <ul class="sidebar-nav" id="sidebar-nav">
        <?php foreach ($sidebar as $item) : ?>
            <li class="nav-item">
                <a class="nav-link <?= $item['Ruta'] == $url_actual ? '' : 'collapsed' ?> <?php echo (!empty($submodulos))? : '' ;?>" href="<?= base_url() . $item['Ruta'] ?>">
                    <i class="<?= $item['Icono'] ?>"></i>
                    <span><?= $item['Nombre'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul> -->
    <ul class="sidebar-nav" id="sidebar-nav">
    <?php foreach ($sidebar as $item) : ?>
        <?php 
            $submodulosRelacionados = array_filter($submodulos, function($sub) use ($item) {
                return $sub['IdModuloPadre'] === $item['IdModulo'];
            });
        ?>
        <li class="nav-item">
            <?php if (!empty($submodulosRelacionados)) : ?>
                <!-- Opción con submódulos -->
                <a class="nav-link <?= $item['Ruta'] == $url_actual ? '' : 'collapsed' ?>" data-bs-toggle="collapse" href="#submenu-<?= $item['IdModulo'] ?>" role="button" aria-expanded="false" aria-controls="submenu-<?= $item['IdModulo'] ?>">
                    <i class="<?= $item['Icono'] ?>"></i>
                    <span><?= $item['Nombre'] ?></span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="collapse <?= $item['Ruta'] == $url_actual ? 'show' : '' ?>" id="submenu-<?= $item['IdModulo'] ?>">
                    <?php foreach ($submodulosRelacionados as $sub) : ?>
                        <li>
                            <a class="nav-link <?= $sub['Ruta'] == $url_actual ? '' : 'collapsed' ?>" href="<?= base_url() . $sub['Ruta'] ?>">
                                <i class="<?= $sub['Icono'] ?>"></i>
                                <?= $sub['Nombre'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <!-- Opción sin submódulos -->
                <a class="nav-link <?= $item['Ruta'] == $url_actual ? '' : 'collapsed' ?>" href="<?= base_url() . $item['Ruta'] ?>">
                    <i class="<?= $item['Icono'] ?>"></i>
                    <span><?= $item['Nombre'] ?></span>
                </a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <div class="mt-5 mb-2">
        <small class="text-center">&copy; 2025 Derechos reservados Distribuidora Rex.</small>
        <br><br>
        <small><i>Versión 2.0.4</i></small>
    </div>
</aside>

<?php echo $this->endSection(); ?>