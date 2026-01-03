$(document).ready(function () {

    $.ajax({
        url: "alertaPersonalContratos",
        type: "POST",
        dataType: "json",
        success: function (data) {

            let list = $(".dropdown-list");
            list.find(".alert-item").remove();

            let totalAlertas = 0;

            data.forEach(alerta => {

                let fechaFin = new Date(alerta.fecha_fin_contrato + "T00:00:00");
                let hoy = new Date();

                // Normalizar horas para evitar errores
                fechaFin.setHours(0, 0, 0, 0);
                hoy.setHours(0, 0, 0, 0);

                let diffTime = fechaFin - hoy;
                let diasRestantes = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // 👉 Solo mostrar alertas con 15 días o menos
                if (diasRestantes <= 15 && diasRestantes <= 0) {

                    totalAlertas++; // contador para el badge

                    // 👉 Texto de alerta según días
                    let texto = "";
                    if (diasRestantes === 0) {
                        texto = "Hoy vence";
                    } else {
                        texto = `Faltan <b>${diasRestantes}</b> días`;
                    }

                    // 👉 TU ALERTA (la que se ve en el dropdown)
                    let item = `
                        <a class="dropdown-item d-flex align-items-center alert-item" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-danger">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                
                            <span class="font-weight-bold">${alerta.fecha_fin_contrato}</span>
                                <div class=" text-gray-bold">${alerta.nombre}</div>
                                <div>${texto}</div>
                            </div>
                        </a>
                    `;

                    list.append(item);
                }

            });

            // 👉 Badge solo con los que cumplen la condición
            $("#alertsDropdown .badge-counter").text(totalAlertas);
        }
    });

});
