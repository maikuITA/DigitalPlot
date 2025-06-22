<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Profilo</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/profilo.css">
    <link href="webfonts/uicons-bold-rounded.css" rel="stylesheet">
    <link href="webfonts/uicons-thin-straight.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                    {if $isLogged === true}
                        <a class="navbar-item">PlotPoints: {$plotPoints}</a>
                        {if $privilege eq 0}
                            <a class="navbar-item" href="/subscribe">Abbonati</a>
                        {/if}
                        {if $privilege === 3}
                            <a class="navbar-item" href="/dashboard" > Dashboard </a>
                            <a class="navbar-item" href="/logs"> Logs </a>
                        {/if}
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
            {if $isLogged === true}
                {if $privilege >= 2}
                    <a href="/newArticle" class="is-ok">
                        <span class="icon is-large is-ok">
                           <i class="fa fa-plus-square" style="font-size:24px"></i>
                        </span>
                    </a>
                {/if}
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-search lens is-ok" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="/profile"><figure class="image is-48x48">
                    {if $proPic === null}
                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png"/>
                    {else}
                        <img class="is-rounded src="data:image/jpeg;base64,{$proPic}"/>
                    {/if}
                </figure></a>
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-sign-out is-ok" aria-hidden="true"></i>
                    </span>
                </a>
            {else}
                <a href="/auth" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="absolute-left">
        <div class="card yes">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon is-small is-left">
                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                    </span>
                    Collegamenti
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="fixed">
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#profile" class="has-text-link">Profilo</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#articles" class="has-text-link">Articoli</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#readings" class="has-text-link">Letture</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="body-container">
        <div class="card">
            <div class="columns">
                <div class="column is-one-fifth">
                    <figure class="image is-128x128">
                        <img src="favicon.ico" alt="Avatar">
                    </figure>
                </div>
                <div class="column is-two-fifth c">
                    <a class="title">NomeUtente</a>
                    <a class="subtitle has-text-warning">tipoAbbonamento</a>
                </div>
                <div class="column is-two-fifth cs">
                    <div class="is-gapped">
                        <a class="is-5 s">Follower</a><a class="is-5">1</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Seguiti</a><a class="is-5">1</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Numero articoli</a><a class="is-5">1</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card articles" id="articles">
            <table class="table is-striped is-hoverable">
                <caption class="title">Articoli caricati</caption>
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Stato</th>
                        <th>Data pubblicazione</th>
                        <th>Genere</th>
                        <th>Modifica</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                {if isset($articles)}
                    {foreach from=$articles item=article}
                            <tr>
                                <td>{$article->getTitle()}</td>
                                <td>{$article->getState()}</td>
                                <td>{$article->getReleaseDate()}</td>
                                <td>{$article->getGenre()}</td>
                                <td><a class="has-text-link" >Modifica</a></td>
                                <td><a class="has-text-danger">Elimina</a></td>
                            </tr>
                        
                    {/foreach}
                {/if}
                </tbody>
            </table>
        </div>
        <div class="card articles">
            <table class="table is-striped is-hoverable" id="readings">
                <caption class="title">Articoli letti</caption>
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Data pubblicazione</th>
                        <th>Tipo</th>
                        <th>Genere</th>
                        <th>Leggi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NomeArticolo</td>
                        <td>01/01/1970</td>
                        <td>Tipo</td>
                        <td>Genere</td>
                        <td><a class="has-text-link">Leggi</a></td>
                    </tr>
                    <tr>
                        <td>NomeArticolo</td>
                        <td>01/01/1970</td>
                        <td>Tipo</td>
                        <td>Genere</td>
                        <td><a class="has-text-link">Leggi</a></td>
                    </tr>
                    <tr>
                        <td>NomeArticolo</td>
                        <td>01/01/1970</td>
                        <td>Tipo</td>
                        <td>Genere</td>
                        <td><a class="has-text-link">Leggi</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>