console.log("textEditor loaded");

// This code initializes a Quill text editor in the HTML element with id 'editor-container'
// Quill is a rich text editor that allows users to write and format text, add links
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

// in this way I can access the quill object globally (for example, when you are in the 'editArticle' screen)
window.quill = quill;


// what happens when the user submits the form
document.getElementById('form-articolo').addEventListener('submit', function (e) {
  // it represents the variable in which quill inserts the content typed by the user in HTML format
  const contenutoHTML = quill.root.innerHTML;
  // it represents the variable in which quill inserts the content typed by the user in plain text format
  const contenutoTesto = quill.getText().trim();

  // the content of the text editor is saved in a hidden input field, in this way you can send it to the server
  const campoHidden = document.getElementById('contenuto-articolo');

  // if the user has not written anything, the hidden input field is set to an empty string, otherwise it is set to the HTML content
  if (contenutoTesto.length === 0) {
    campoHidden.value = "";
  } else {
    campoHidden.value = contenutoHTML;
  }
});