const fileInput = document.getElementById('upload');
const fileStatus = document.getElementById('fileStatus');

    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];

      if (file) {
        if (file.type === "text/plain") {
          fileStatus.textContent = `✅ File "${file.name}" caricato con successo.`;
          fileStatus.style.color = 'green';
        } else {
          fileStatus.textContent = `❌ Il file selezionato non è un file .txt valido.`;
          fileStatus.style.color = 'red';
        }
      } else {
        fileStatus.textContent = '';
    }
});
 
