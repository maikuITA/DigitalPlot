console.log("textEditor loaded");

const quill = new Quill('#editor-container', {
    theme: 'snow',
    placeholder: 'Scrivi il tuo articolo qui...',
    modules: {
      toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'blockquote', 'code-block'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        ['clean']
      ]
    }
  });


  document.getElementById('form-articolo').addEventListener('submit', function (e) {
  const contenutoHTML = quill.root.innerHTML;
  const contenutoTesto = quill.getText().trim();

  const campoHidden = document.getElementById('contenuto-articolo');

  // Se il testo è vuoto (quindi non è stato scritto nulla di utile)
  if (contenutoTesto.length === 0) {
    campoHidden.value = ""; 
  } else {
    campoHidden.value = contenutoHTML;
  }
});