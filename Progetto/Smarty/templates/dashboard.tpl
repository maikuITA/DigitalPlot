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
                        <img class="is-rounded" src="data:image/jpeg;base64,{$proPic}"/>
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
                    Utenti</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <a class="is-5 s">Registrati: </a><a id="totalU" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Abbonati: </a><a id="abbAttivi" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Mensile: </a><a id="" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Totale: </a><a id="" class="is-5">0000</a> <br/>
                    </div>
                    <time datetime="{$smarty.now|date_format:"%Y-%m-%d"}">{$smarty.now|date_format:"%d/%m/%Y"}</time>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><span class="icon is-small is-left">
                        <i class="fa fa-line-chart" aria-hidden="true"></i></span>Abbonamenti</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <a class="is-5 s">Giornaliero: </a><a id="last24P" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Settimanale: </a><a id="lastSP" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Mensile: </a><a id="lastMP" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Totale: </a><a id="totalP" class="is-5">0000</a> <br/>
                    </div>
                    <time datetime="{$smarty.now|date_format:"%Y-%m-%d"}">{$smarty.now|date_format:"%d/%m/%Y"}</time>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><span class="icon is-small is-left">
                        <i class="fa fa-line-chart" aria-hidden="true"></i></span>Articoli</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="content">
                        <a class="is-5 s">Giornaliero: </a><a id="last24A" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Settimanale: </a><a id="lastSA" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Mensile: </a><a id="lastMA" class="is-5">0000</a> <br/>
                        <a class="is-5 s">Totale: </a><a id="totalA" class="is-5">0000</a> <br/>
                    </div>
                        <time datetime="{$smarty.now|date_format:"%Y-%m-%d"}">{$smarty.now|date_format:"%d/%m/%Y"}</time>
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
                    Qui trovi la lista di tutti gli articoli che stanno aspettando l'approvazione per poter essere pubblicati uffiialmente
                </h2>
                <table class="table is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Autore</th>
                        <th>Data pubblicazione</th>
                        <th>Tipo</th>
                        <th>Genere</th>
                        <th>Leggi</th>
                        <th>Approva</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    {if isset($articoliDaRevisionare)}
                        {foreach from=$articoliDaRevisionare item=article}
                                <tr>
                                    <td>{$article->getTitle()}</td>
                                    <td>{$article->getWriter()->getUsername()}</td>
                                    <td>{$article->getReleaseDate()->format('Y-m-d')}</td>
                                    <td>{$article->getCategory()}</td>
                                    <td>{$article->getGenre()}</td>
                                    <td><a class="has-text-link" href="/article/{$article->getId()}" >Leggi</a></td>
                                    <td><a class="has-text-success" href="/article/{$article->getId()}" >Approva</a></td>
                                    <td><a class="has-text-danger" href="/dropArticle/{$article->getId()}"> Elimina</a></td>
                                </tr>           
                        {/foreach}
                    {/if}        
                </tbody>
            </table>
            </section>
            <section class="section">
                <a class="title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </span>
                    Nuovi articoli pubblicati
                </a>
                <h2 class="subtitle">
                    Qui trovi gli ultimi 10 articoli pubblicati sul sito che sono stati approvati
                </h2>
                <table class="table is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Autore</th>
                        <th>Stato</th>
                        <th>Data pubblicazione</th>
                        <th>Tipo</th>
                        <th>Genere</th>
                        <th>Leggi</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    {if isset($articoliPubblicati)}
                        {foreach from=$articoliPubblicati item=article}
                                <tr>
                                    <td>{$article->getTitle()}</td>
                                    <td>{$article->getWriter()->getUsername()}</td>
                                    <td>{$article->getState()}</td>
                                    <td>{$article->getReleaseDate()->format('Y-m-d')}</td>
                                    <td>{$article->getCategory()}</td>
                                    <td>{$article->getGenre()}</td>
                                    <td><a class="has-text-link" href="/article/{$article->getId()}" >Leggi</a></td>
                                    <td><a class="has-text-danger" href="/dropArticle/{$article->getId()}"> Elimina</a></td>
                                </tr>           
                        {/foreach}
                    {/if}           
                </tbody>
            </table>
            </section>
            <section class="section">
                <a class="title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                    </span>
                    Commenti in attesa di moderazione
                </a>
                <h2 class="subtitle">
                    Qui trovi tutti i commenti raggruppati per data e articolo
                </h2>
                <table class="table is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>Autore</th>
                        <th>Data pubblicazione</th>
                        <th>Articolo</th>
                        <th>Valutazione</th>
                        <th>Leggi</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    {if isset($commenti)}
                        {foreach from=$commenti item=commento}
                                <tr>
                                    <td>{$commento->getSubscriber()->getUsername()}</td>
                                    <td>{$commento->getReleaseDate()->format('Y-m-d')}</td>
                                    <td>{$commento->getArticle()->getTitle()}</td>
                                    <td>{$commento->getEvaluate()}</td>
                                    <td><a class="has-text-link" href="/article/{$commento->getArticle()->getId()}" >Leggi</a></td>
                                    <td><a class="has-text-danger" href="/dropReview/{$commento->getCod()}"> Elimina</a></td>
                                </tr>           
                        {/foreach}
                    {/if}          
                </tbody>
            </table>
            </section>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>
<script src="/Progetto/Smarty/js/dashboard.js"></script>