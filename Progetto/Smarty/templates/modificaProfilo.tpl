<!DOCTYPE html>
<html lang="it" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>DigitalPlot-Modifica Profilo</title>
        <link rel="stylesheet" href="/Progetto/Smarty/css/bulma/bulma.css" />
        <link rel="stylesheet" href="/Progetto/Smarty/css/index.css" />
        <link
            rel="stylesheet"
            href="/Progetto/Smarty/css/modificaprofilo.css"
        />
        <link href="webfonts/uicons-bold-rounded.css" rel="stylesheet" />
        <link href="webfonts/uicons-thin-straight.css" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <header class="header columns">
            <div class="column is-one-quarter left">
                <a
                    role="button"
                    class="navbar-burger"
                    id="burger"
                    aria-label="menu"
                    aria-expanded="false"
                    data-target="navbarBasicExample"
                >
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="/home">Home</a>
                        {if $isLogged === true} {if $privilege eq 0}
                        <a class="navbar-item" href="/subscribe">Abbonati</a>
                        {/if} {if $privilege >= 2}
                        <hr class="navbar-divider" />
                        <a
                            class="navbar-item"
                            id="new_mobile"
                            href="/newArticle"
                            >Nuovo articolo</a
                        >
                        <a class="navbar-item" id="new_find" href="/find"
                            >Ricerca</a
                        >
                        {/if} {if $privilege === 3}
                        <hr class="navbar-divider" />
                        <a class="navbar-item" href="/dashboard"> Dashboard </a>
                        <a class="navbar-item" href="/logs"> Logs </a>
                        {/if}
                        <hr class="navbar-divider" />
                        <a class="navbar-item" id="new_logout" href="/logout"
                            >Logout</a
                        >
                        <hr class="navbar-divider" />
                        <a class="navbar-item">PlotPoints: {$plotPoints}</a>
                        {/if}
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
                {if $isLogged === true} {if $privilege >= 2}
                <a href="/newArticle" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i
                            class="fa fa-plus-square"
                            style="font-size: 24px"
                        ></i>
                    </span>
                </a>
                {/if}
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i
                            class="fa fa-search lens is-ok"
                            aria-hidden="true"
                        ></i>
                    </span>
                </a>
                <a href="/profile"
                    ><figure class="image is-48x48">
                        {if $proPic === null}
                        <img
                            class="is-rounded"
                            src="/Progetto/Smarty/img/propic.png"
                        />
                        {else}
                        <img
                            class="is-rounded"
                            src="data:image/jpeg;base64,{$proPic}"
                        />
                        {/if}
                    </figure></a
                >
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-sign-out is-ok" aria-hidden="true"></i>
                    </span>
                </a>
                {/if}
            </div>
        </header>
        <div class="body-container">
            <div class="card">
                <form action="/confirmEditProfile" method="POST" class="form">
                    <label class="title is-3" for="login-form"
                        >Modifica i tuoi dati</label
                    >
                    <div class="field">
                        <a class="subtitle is-6 has-text-link">Username</a>
                        <p class="control has-icons-left alr">
                            <input
                                class="input"
                                type="text"
                                name="username"
                                id="username"
                                value="{$user->getUsername()}"
                                required
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="fa fa-user-circle"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <a class="subtitle is-6 has-text-link">Bio</a>
                        <p class="control has-icons-left alr">
                            <textarea
                                class="textarea"
                                name="biography"
                                id="c_body"
                            >
{$user->getBiography()}</textarea
                            >
                        </p>
                    </div>
                    <div class="field">
                        <a class="subtitle is-6 has-text-link">Old password</a>
                        <p class="control has-icons-left alr">
                            <input
                                class="input"
                                type="password"
                                placeholder="Vecchia password"
                                name="old-password"
                                required
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="fas fa-key"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <a class="subtitle is-6 has-text-link">New password</a>
                        <p class="control has-icons-left alr">
                            <input
                                class="input"
                                type="password"
                                placeholder="Nuova password"
                                name="new-password"
                                required
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="fas fa-key"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <a class="subtitle is-6 has-text-link"
                            >Confirm new password</a
                        >
                        <p class="control has-icons-left">
                            <input
                                class="input"
                                type="password"
                                placeholder="Conferma password"
                                name="new-password2"
                                id="password2"
                                required
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="fas fa-key"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <div class="control alr">
                            <button
                                class="button is-link is-rounded is-outlined mt-5"
                                type="submit"
                            >
                                <span>
                                    <i class="fas fa-pen"></i>
                                    <a>Modifica profilo</a>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>
