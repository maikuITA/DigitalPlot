// Al submit, copia il contenuto HTML dentro l’input hidden
document.querySelector('form-articolo').addEventListener('submit', function () {
  const html = quill.root.innerHTML;
  document.getElementById('contenuto-articolo').value = html;
});