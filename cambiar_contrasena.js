document.addEventListener('DOMContentLoaded', function () {
    var formulario = document.querySelector('form');
    formulario.addEventListener('submit', function (event) {
      if (!validarFormulario()) {
        event.preventDefault(); // Evitar que el formulario se envíe si la validación falla
      }
    });
  });
  
  function validarFormulario() {
    var contraseña = document.getElementById("contraseña").value;
    var confirmarContraseña = document.getElementById("confirmarContraseña").value;
  
    if (contraseña !== confirmarContraseña) {
      alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
      return false;
    }
    
    // Redirige a la página "perfil.php"
    window.location.href = "perfil.php";
    
    return true;
  }