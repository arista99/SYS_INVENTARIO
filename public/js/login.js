window.addEventListener("DOMContentLoaded", () => {


 // Bloquear clic derecho
document.addEventListener('contextmenu', function(e) {
  e.preventDefault();
  alert('Clic derecho deshabilitado');
});

// Bloquear teclas F12, Ctrl+Shift+I/J, Ctrl+U
document.addEventListener('keydown', function(e) {
  // F12
  if (e.keyCode === 123) {
      e.preventDefault();
      alert('Esta acción está deshabilitada');
  }
  // Ctrl+Shift+I o Ctrl+Shift+J
  if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) {
      e.preventDefault();
      alert('Esta acción está deshabilitada');
  }
  // Ctrl+U
  if (e.ctrlKey && e.keyCode === 85) {
      e.preventDefault();
      alert('Esta acción está deshabilitada');
  }
});


  //LOGEO DE USUARIO VIA AJAX
  $("#btn-loginU").click(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    //let formData = $("#frmAjaxLogin").serialize(); // Serializa los datos del formulario
    
    let datos = $("#frmAjaxLogin").serialize(); // Serializa los datos del formulario

    //console.log(formData);
    $.ajax({
      type: 'POST',
      url: 'LoginUsuario', // Ruta del controlador PHP
      data: datos,
      dataType: 'json', // Indicamos que esperamos un JSON
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            timer: 1500,
            showConfirmButton: false,
          }).then(function () {
            window.location.href = response.redirect; // Redirige según el rol
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error en la conexión',
          timer: 2000,
          showConfirmButton: false,
        });
      },
    });
  });
});
