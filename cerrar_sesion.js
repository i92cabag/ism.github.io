
  // Función para cerrar sesión
  function cerrarSesion() {
    alert("¡Sesión cerrada!");
    actualizarEstadoSesion(false);
  }
  
  // Función para actualizar el estado de la sesión en la interfaz
  function actualizarEstadoSesion(sesionCerrada) {

    var botonCerrarSesion = document.querySelector('#estado-sesion button:nth-child(2)');
  
    if (sesionCerrada) {
      botonIniciarSesion.style.display = 'block';
      botonCerrarSesion.style.display = 'none';
    }
  }
  

  actualizarEstadoSesion(false);
  