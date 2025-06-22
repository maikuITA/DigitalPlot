<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Accesso</title>
    <link rel="stylesheet" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" href="/Progetto/Smarty/css/accesso.css">
    <link href="webfonts/uicons-bold-rounded.css" rel="stylesheet">
    <link href="webfonts/uicons-thin-straight.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header columns">
        <div class="column is-one-quarter left">
            <a role="button" class="navbar-burger" id="burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/home">Home</a>
                    <a class="navbar-item" href="/abbonati">Abbonati</a>
                </div>
            </div>
        </div>
        <div class="column">
            <div>
                <a class="title is-1">Digital</a>
                <a class="title is-1 has-text-warning">Plot</a>
            </div> 
        </div>
        <div class="column is-one-quarter right">
            
        </div>
    </header>
    <div class="body-container">
        <div class="content" id="content">
            <div class="tabs is-medium is-centered">
                <ul>
                    <li id="log" class="is-active"><a onclick="showLogin()"><i class="fa fa-key fa-fw"></i>Login</a></li>
                    <li id="reg"><a onclick="showRegis()"><i class="fa fa-book fa-fw" aria-hidden="true"></i>Registrazione</a></li>
                </ul>
            </div>
            <div class="container">
                <form action="/checkLogin" method="post" class="form" id="login-form">
                    <label class="title is-3" for="login-form">Accedi al tuo account</label>
                    <div class="field">
                        <p class="control has-icons-left alr">
                            <input class="input" type="text" placeholder="Username" name="username" id="username" required>
                            <span class="icon is-small is-left has-link">
                            <i class="fa fa-user-circle"></i>
                            </span> 
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left alr">
                            <input class="input" type="password" placeholder="Inserisci la tua password" name="password" required>
                            <span class="icon is-small is-left has-link">
                            <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <div class="control alr">
                            <button type="submit" class="button is-link is-fullwidth">Accedi</button>
                        </div>
                    </div>
                </form>
                <form action="https://digitalplot.altervista.org/registrazione" method="post" class="form regis" id="regis-form">
                    <label class="title is-3" for="login-form">Crea il tuo account</label>
                    <div class="grigliata" id="grigliata">
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Nome" name="name" id="name" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Cognome" name="surname" id="surname" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="date" name="birthdate" id="birthdate" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-calendar"></i> 
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Paese di nascita" name="country" id="country" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Luogo di nascita" name="birthplace" id="birthplace" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Provincia" name="province" id="province" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="CAP" name="zipCode" id="zipCode" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Indirizzo" name="streetAddress" id="streetAddress" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Numero Civico" name="streetNumber" id="streetNumber" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Telefono" name="telephone" id="telephone" pattern ="[0-9]{10}" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="text" placeholder="Username" name="username" id="username" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fa fa-user-circle"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="email" placeholder="Inserisci la tua email" name="email" id="email" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fas fa-envelope"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="password" placeholder="Inserisci la tua password" name="password" id="password" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="password" placeholder="Conferma la tua password" name="password2" id="password2" required>
                                <span class="icon is-small is-left has-link">
                                <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="field out">
                        <div class="control">
                            <button type="submit" class="button is-link is-fullwidth" id="submit-regis">Registrati</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/accesso.js"></script>
<script src="/Progetto/Smarty/js/navburger.js"></script>