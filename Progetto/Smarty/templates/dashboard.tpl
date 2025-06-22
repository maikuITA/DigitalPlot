<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/dashboard.css">
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
                            <a class="navbar-item" href="/logs" > Logs </a>
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
    <div class="body-container">
        <div class="body-left">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon is-small is-left">
                            <i class="fa fa-line-chart" aria-hidden="true"></i>
                        </span>
                    Utenti registrati</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
                        iaculis mauris.</p>
                        <a class="has-text-link">@admin</a>
                        <time datetime="2016-1-1">15:51 PM - 7 Jun 2025</time>
                    </div>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><span class="icon is-small is-left"><i class="fa fa-line-chart" aria-hidden="true"></i></span>Utenti abbonati</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
                        iaculis mauris.</p>
                        <a class="has-text-link">@admin</a>
                        <time datetime="2016-1-1">15:51 PM - 7 Jun 2025</time>
                    </div>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><span class="icon is-small is-left"><i class="fa fa-line-chart" aria-hidden="true"></i></span>Articoli totali</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
                        iaculis mauris.</p>
                        <a class="has-text-link">@admin</a>
                        <time datetime="2016-1-1">15:51 PM - 7 Jun 2025</time>
                    </div>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><span class="icon is-small is-left"><i class="fa fa-line-chart" aria-hidden="true"></i></span>Attività odierna</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
                        iaculis mauris.</p>
                        <a class="has-text-link">@admin</a>
                        <time datetime="2016-1-1">15:51 PM - 7 Jun 2025</time>
                    </div>
                </div>
            </div>
        </div>
        <div class="body-right">
            <section class="section">
                <a class="title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                    </span>
                    Articoli in attesa di revisione
                </a>
                <h2 class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.
                </h2>
            </section>
            <section class="section">
                <a class="title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </span>
                    Nuovi articoli pubblicati
                </a>
                <h2 class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.
                </h2>
            </section>
            <section class="section">
                <a class="title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                    </span>
                    Commenti in attesa di moderazione
                </a>
                <h2 class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.
                </h2>
            </section>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>