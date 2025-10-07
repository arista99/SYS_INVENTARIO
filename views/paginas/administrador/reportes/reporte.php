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
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Vencimiento de Garantías</h6>
            </div>
            <div class="card-body">
                <canvas id="chartGarantias"></canvas>
            </div>
        </div>
    </div>

</div>

</div>
<!-- /.container-fluid -->

<!-- Footer -->
<?php include_once('views/modulos/footer.php'); ?>


<!-- =========================
     SCRIPTS DE CHART.JS
========================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Activos por Estado
    new Chart(document.getElementById("chartEstado"), {
        type: 'doughnut',
        data: {
            labels: ["Asignado", "Disponible", "Reparación", "Baja"],
            datasets: [{
                data: [120, 45, 10, 5], // Ejemplo estático
                backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Activos por Área
    new Chart(document.getElementById("chartArea"), {
        type: 'bar',
        data: {
            labels: ["Sistemas", "Logística", "Administración", "Ventas"],
            datasets: [{
                label: "Activos",
                data: [50, 30, 20, 15],
                backgroundColor: "#36b9cc"
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Vencimiento de Garantías
    new Chart(document.getElementById("chartGarantias"), {
        type: 'line',
        data: {
            labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun"],
            datasets: [{
                label: "Garantías por vencer",
                data: [5, 7, 4, 10, 3, 8],
                borderColor: "#f6c23e",
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            responsive: true
        }
    });
</script>