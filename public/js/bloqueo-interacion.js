window.addEventListener("DOMContentLoaded", () => {
    // Bloquear clic derecho
    document.addEventListener("contextmenu", function (e) {
      e.preventDefault();
      alert("Clic derecho deshabilitado");
    });
  
    // Bloquear teclas F12, Ctrl+Shift+I/J, Ctrl+U
    document.addEventListener("keydown", function (e) {
      // F12
      if (e.keyCode === 123) {
        e.preventDefault();
        alert("Esta acción está deshabilitada");
      }
      // Ctrl+Shift+I o Ctrl+Shift+J
      if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) {
        e.preventDefault();
        alert("Esta acción está deshabilitada");
      }
      // Ctrl+U
      if (e.ctrlKey && e.keyCode === 85) {
        e.preventDefault();
        alert("Esta acción está deshabilitada");
      }
    });
  });
  