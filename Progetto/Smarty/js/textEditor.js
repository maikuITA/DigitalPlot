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

  // Al submit, mettiamo l'HTML dentro il campo hidden
  document.getElementById('form-articolo').addEventListener('submit', function (e) {
    const contenutoHTML = quill.root.innerHTML;
    document.getElementById('contenuto-articolo').value = contenutoHTML;
  });