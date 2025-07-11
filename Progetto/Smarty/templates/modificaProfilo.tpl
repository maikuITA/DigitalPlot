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
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
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
                        {else}
                        <a
                            class="navbar-item has-text-link transfer"
                            href="/auth"
                            >Accedi</a
                        >
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
                            class="bi bi-file-plus-fill"
                            style="font-size: 2rem"
                        ></i>
                    </span>
                </a>
                {/if}
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="bi bi-search" style="font-size: 1.3rem"></i>
                    </span>
                </a>
                <a href="/profile">
                    <figure class="image is-48x48">
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
                    </figure>
                </a>
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i
                            class="bi bi-box-arrow-right"
                            style="font-size: 1.3rem"
                        ></i>
                    </span>
                </a>
                {else}
                <a href="/auth" class="button is-warning ok">Accedi</a>
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
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="bi bi-person-fill"></i>
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
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="bi bi-key-fill"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <a class="subtitle is-6 has-text-link">New password</a>
                        <p class="control has-icons-left alr">
                            <input class="input" type="password"
                            placeholder="Nuova password" name="new-password"
                            {literal}
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                            {/literal} />
                            <span class="icon is-small is-left has-link">
                                <i class="bi bi-key-fill"></i>
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
                            />
                            <span class="icon is-small is-left has-link">
                                <i class="bi bi-key-fill"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <div class="control alr">
                            <button
                                class="button is-link is-rounded is-outlined mt-5"
                                type="submit"
                                id="submit-modify"
                            >
                                <span>
                                    <i class="bi bi-pencil-fill"></i>
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
<script src="/Progetto/Smarty/js/chekUser.js"></script>
