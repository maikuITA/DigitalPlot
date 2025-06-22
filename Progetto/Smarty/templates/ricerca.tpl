<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Ricerca</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/ricerca.css">
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
            <section class="section">
                <p class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                </p>
                <form class="field is-grouped" method="POST" action="/search">
                    <div class="control has-icons-left" >
                        <input class="input is-rounded" type="text" placeholder="Titolo..." name="title">
                        <span class="icon is-small is-left has-link">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="select is-rounded">
                        <select name='category'>
                            <option value = '' >Tipo</option>
                            <option value = 'articolo' >Articolo</option>
                            <option value = 'giornale' >Giornale</option>
                            <option value = 'rivista' >Rivista</option>
                        </select>
                    </div>
                    <div class="select is-rounded">
                        <select name = 'genre' >
                            <option value = '' >Genere</option>
                            <option value = 'cronaca' >Cronaca</option>
                            <option value = 'economia' >Economia</option>
                            <option value = 'politica' >Politica</option>
                            <option value = 'sport' >Sport</option>
                        </select>
                    </div>
                    <div class="select is-rounded">
                        <select name = 'date' >
                            <option value = '' >Anno</option>
                            <option value = '2025' >2025</option>
                            <option value = '2024' >2024</option>
                            <option value = '2023' >2023</option>
                        </select>
                    </div>
                    <div class="control">
                        <button class="button is-link is-fullwidth is-rounded">Invia</button>
                    </div>
                </form>
            </section>
            <div class="container" id="container">
                {if isset($articles)}
                    {foreach from=$articles item=article}
                        <div class="card">
                            <div class="card-content">
                                <p class="title">{$article->getTitle()}</p>
                                <p class="subtitle">{$article->getDescription()}</p>
                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item">
                                    <a href="/article" class="button is-warning">Leggi di più</a>
                                </p>
                            </footer>
                        </div>
                    {/foreach}
                {/if}
            </div>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>