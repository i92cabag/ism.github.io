document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const correoInput = document.getElementById("correo");
    const contraseñaInput = document.getElementById("contraseña");
  
    form.addEventListener("submit", function (event) {
      event.preventDefault(); 
  
      const correoValue = correoInput.value.trim();
      const contraseñaValue = contraseñaInput.value.trim();
  
      if (correoValue === "" || contraseñaValue === "") {
        alert("Por favor, completa todos los campos.");
      } else {
        alert(`¡Bienvenido, ${correoValue}!`);
      }
    });
  });
  