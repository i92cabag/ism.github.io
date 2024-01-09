document.getElementById('form-container').addEventListener('submit', function(event) {
  event.preventDefault();

  var formData = new FormData(this);

  fetch('crear_casa.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    console.log(data);
    window.location.href = 'tus_casas.html';
  })
  .catch(error => console.error('Error:', error));
});
