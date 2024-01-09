document.addEventListener('DOMContentLoaded', function () {
  var formulario = document.querySelector('form');
  formulario.addEventListener('submit', function (event) {
    if (!validarFormulario()) {
      event.preventDefault();
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
  
  // Redirige a la página "tus_casas.html"
  window.location.href = "tus_casas.html";
  
  return true;
}
document.addEventListener('DOMContentLoaded', function () {
  const fotoInput = document.getElementById('foto');
  const previewImage = document.getElementById('preview');

  fotoInput.addEventListener('change', function () {
    const file = fotoInput.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
      };

      reader.readAsDataURL(file);
    }
  });
});
