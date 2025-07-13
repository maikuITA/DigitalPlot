<!DOCTYPE html>
<html lang="it" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Profilo</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/profilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="header columns">
        <div class="column is-one-quarter left">
            <a role="button" class="navbar-burger" id="burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
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
                    <a class="navbar-item" id="new_mobile" href="/newArticle">Nuovo articolo</a>
                    <a class="navbar-item" id="new_find" href="/find">Ricerca</a>
                    {/if} {if $privilege === 3}
                    <hr class="navbar-divider" />
                    <a class="navbar-item" href="/dashboard"> Dashboard </a>
                    <a class="navbar-item" href="/logs"> Logs </a>
                    {/if}
                    <hr class="navbar-divider" />
                    <a class="navbar-item" id="new_logout" href="/logout">Logout</a>
                    <hr class="navbar-divider" />
                    <a class="navbar-item">PlotPoints: {$plotPoints}</a>
                    {else}
                    <a class="navbar-item has-text-link transfer" href="/auth">Accedi</a>
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
                    <i class="bi bi-file-plus-fill" style="font-size: 2rem"></i>
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
                    <img class="is-rounded" src="/Progetto/Smarty/img/propic.png" />
                    {else}
                    <img class="is-rounded" src="data:image/jpeg;base64,{$proPic}" />
                    {/if}
                </figure>
            </a>
            <a href="/logout" class="is-ok">
                <span class="icon is-large is-ok">
                    <i class="bi bi-box-arrow-right" style="font-size: 1.3rem"></i>
                </span>
            </a>
            {else}
            <a href="/auth" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="body-container">
        <div class="card">
            <div class="columns">
                <div class="column is-one-fifth">
                    <figure class="image is-100x100">
                        <form id="avatarForm" action="/uploadAvatar" method="POST" enctype="multipart/form-data">
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                            {if $proPic === null}
                            <label for="avatarInput" class="avatar-wrapper">
                                <img src="/Progetto/Smarty/img/propic.png" alt="Foto profilo" id="avatarPreview"
                                    class="profilePictureU">
                                <i class="bi bi-camera-fill camera-icon"></i>
                            </label>
                            {else}
                            <label for="avatarInput" class="avatar-wrapper">
                                <img class="is-rounded" src="data:image/jpeg;base64,{$proPic}" id="avatarPreview"
                                    class="profilePictureU" />
                            </label>
                            {/if}
                        </form>
                    </figure>
                    </form>
                </div>
                <div class="column is-two-fifth c">
                    <a class="title">{$user->getUsername()}</a>
                    {if $user->getPrivilege() === 0}
                    <a class="subtitle has-text-warning">Utente base</a>
                    {elseif $user->getPrivilege() === 1}
                    <a class="subtitle has-text-warning">Utente reader</a>
                    {elseif $user->getPrivilege() === 2}
                    <a class="subtitle has-text-warning">Utente writer</a>
                    {elseif $user->getPrivilege() === 3}
                    <a class="subtitle has-text-warning">Amministratore</a>
                    {/if}

                </div>
                <div class="column is-two-fifth cs">
                    <div class="is-gapped">
                        <a class="is-5 s">Follower</a><a class="is-5">{$user->getNumFollowers()}</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Seguiti</a><a class="is-5">{$user->getNumFollowing()}</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Articoli scritti</a><a class="is-5">{$user->getNumArticles()}</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Articoli letti</a><a class="is-5">{$user->countReadings()}</a>
                    </div>
                </div>
            </div>
            <div>
                <p class="is-5 s"> Biografia </p>{$user->getBiography()}
            </div>

        </div>
        <div class="card articles">
            <table class="table is-striped is-hoverable" id="readings">
                <caption class="title">Followers</caption>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Paese</th>
                        <th>Data di Nascita</th>
                    </tr>
                </thead>
                <tbody>
                    {if isset($followers)}
                    {foreach from=$followers item=follow}
                    <tr>
                        <td>{$follow->getFollowing()->getUsername()}</td>
                        <td>{$follow->getFollowing()->getName()}</td>
                        <td>{$follow->getFollowing()->getSurname()}</td>
                        <td>{$follow->getFollowing()->getCountry()}</td>
                        <td>{$follow->getFollowing()->getBirthDate()->format('Y-m-d')}</td>
                    </tr>
                    {/foreach}
                    {/if}
                </tbody>
            </table>
        </div>
        <div class="card articles">
            <table class="table is-striped is-hoverable" id="readings">
                <caption class="title">Following</caption>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Paese</th>
                        <th>Data di Nascita</th>
                    </tr>
                </thead>
                <tbody>
                    {if isset($following)}
                    {foreach from=$following item=follow}
                    <tr>
                        <td>{$follow->getFollower()->getUsername()}</td>
                        <td>{$follow->getFollower()->getName()}</td>
                        <td>{$follow->getFollower()->getSurname()}</td>
                        <td>{$follow->getFollower()->getCountry()}</td>
                        <td>{$follow->getFollower()->getBirthDate()->format('Y-m-d')}</td>
                    </tr>
                    {/foreach}
                    {/if}
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>
<script src="/Progetto/Smarty/js/profile.js"></script>