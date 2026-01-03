$(document).ready(function () {

    // Activos por Area
    $.ajax({
        url: "listarActivosEstados",
        type: "POST",
        data: { action: "getActivosEstado" },
        dataType: "json",
        success: function (data) {

            // Extraer labels y datos desde el JSON
            let labels = data.map(item => item.estado);
            let totals = data.map(item => item.total);

            new Chart(document.getElementById("chartEstado"), {
                type: 'doughnut',
                data: {
                    labels: labels,   // <- Labels dinámicos
                    datasets: [{
                        data: totals,   // <- Datos dinámicos
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
        }
    });

    // Activos por Area
    $.ajax({
        url: "listarActivosAreas",
        type: "POST",
        data: { action: "getActivosArea" },
        dataType: "json",
        success: function (data) {

            // Extraer labels y datos desde el JSON
            let labels = data.map(item => item.area_usuario);
            let totals = data.map(item => item.total);

            new Chart(document.getElementById("chartArea"), {
                type: 'bar',
                data: {
                    labels: labels,   // <- Labels dinámicos
                    datasets: [{
                        label: "Activos",
                        data: totals,   // <- Datos dinámicos
                        backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
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
        }
    });
});