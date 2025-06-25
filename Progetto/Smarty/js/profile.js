console.log("profile loaded");

document.getElementById('upload').addEventListener('change', function () {
    if (this.files.length > 0) {
        document.getElementById('form-articolo').submit();
    }
});

