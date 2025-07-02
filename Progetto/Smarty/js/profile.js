console.log("profile loaded");

document.getElementById('avatarInput').addEventListener('change', function () {
    if (this.files.length > 0) {
        document.getElementById('avatarForm').submit();
    }
});

