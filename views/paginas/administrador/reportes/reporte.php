<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- =========================
         REPORTES GRÁFICOS
    ========================== -->
<div class="row">

    <!-- Activos por Estado -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Activos por Estado</h6>
            </div>
            <div class="card-body">
                <canvas id="chartEstado"></canvas>
            </div>
        </div>
    </div>

    <!-- Activos por Área -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Activos por Área</h6>
            </div>
            <div class="card-body">
                <canvas id="chartArea"></canvas>
            </div>
        </div>
    </div>

    <!-- Vencimiento de Garantías -->
    <!-- <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Vencimiento de Garantías</h6>
            </div>
            <div class="card-body">
                <canvas id="chartGarantias"></canvas>
            </div>
        </div>
    </div> -->

</div>

</div>
<!-- /.container-fluid -->

<!-- Footer -->
<?php include_once('views/modulos/footer.php'); ?>


<!-- =========================
     SCRIPTS DE CHART.JS
========================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="public/js/ajaxEventosReportes.js"></script>