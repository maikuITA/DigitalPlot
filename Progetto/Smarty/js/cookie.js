function areCookiesEnabled() {
    document.cookie = "cookie_test=1; path=/; SameSite=Strict";
    if (document.cookie.indexOf("cookie_test=1") === -1) {
        alert("Attenzione: i cookie sono disattivati nel browser. L'app potrebbe non funzionare correttamente.");
    }
}
window.onload = areCookiesEnabled;
