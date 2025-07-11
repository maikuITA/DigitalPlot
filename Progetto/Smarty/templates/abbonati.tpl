<!DOCTYPE html>
<html lang="it" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigitalPlot-Abbonati</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css" />
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css" />
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/abbonati.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
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
                <span class="icon is-large is-ok prova">
                    <i class="bi bi-file-plus-fill" style="font-size: 2rem"></i>
                </span>
            </a>
            {/if}
            <a href="/find" class="is-ok">
                <span class="icon is-large is-ok prova">
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
                <span class="icon is-large is-ok prova">
                    <i class="bi bi-box-arrow-right" style="font-size: 1.3rem"></i>
                </span>
            </a>
            {else}
            <a href="/auth" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="container" id="container">
        <label class="title is-3 mt-4 mb-4">Piani di sottoscrizione</label>
    </div>
    <div class="container" id="container">
        {if isset($subscriptions)} {foreach from=$subscriptions
        item=subscription}
        <div class="card mb-5">
            <div class="card-content">
                <p class="title is-centered">{$subscription->getType()}</p>
                {if $subscription->getType() === "writer"}
                <div class="content">
                    Descrizione: <br />
                    Con l’abbonamento Writer potrai accedere all’area
                    riservata per pubblicare i tuoi articoli, raccontare
                    esperienze, condividere progetti e confrontarti con
                    altri utenti. Avrai anche accesso illimitato alla
                    lettura dei contenuti. Unisciti alla community e fai
                    sentire la tua voce nel nostro spazio editoriale.
                </div>
                {else}
                <div class="content">
                    Descrizione: <br />
                    Attivando l’abbonamento potrai accedere a tutti gli
                    articoli completi pubblicati sul sito, senza alcun
                    limite. Approfondimenti, storie, analisi e guide:
                    contenuti curati e aggiornati per offrirti una lettura
                    stimolante e affidabile. Resta sempre informato e
                    lasciati ispirare da voci diverse e prospettive
                    originali.
                </div>
                {/if}
                <p class="subtitle">Durata: {$subscription->getPeriod()}</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a class="button is-warning"
                        href="/startPurchase/{$subscription->getCod()}">{$subscription->getPrice()} €</a>
                </p>
            </footer>
        </div>
        {/foreach} {/if}
    </div>
</body>

</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>