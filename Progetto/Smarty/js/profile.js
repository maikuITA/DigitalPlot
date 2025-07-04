console.log("profile loaded");

document.getElementById('avatarInput').addEventListener('change', function () {
    if (this.files.length > 0) { // checks the file's size 
        document.getElementById('avatarForm').submit();
    }
});

