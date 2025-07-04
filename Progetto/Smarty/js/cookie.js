function areCookiesEnabled() {
    document.cookie = "cookie_test=1; path=/; SameSite=Strict";  // path refers to the web pages in which the cookie is enable, the third parameter means that if the web site belongs as an iframe in another web site, the cookie is not sent to the server
    if (document.cookie.indexOf("cookie_test=1") === -1) {  // checks if the position of the cookie is -1, which means that the cookie is not set
        alert("Attenzione: i cookie sono disattivati nel browser. L'app potrebbe non funzionare correttamente.");
    }
}
window.onload = areCookiesEnabled;
