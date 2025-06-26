// Al submit, copia il contenuto HTML dentro l’input hidden
document.querySelector('#form-articolo').addEventListener('submit', function () {
  document.getElementById('contenuto-articolo').value = quill.root.innerHTML;
});