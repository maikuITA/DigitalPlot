<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-NuovoArticolo</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/new.css">
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
    <div class="absolute-right">
        <div class="card cart">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon is-small is-left">
                        <i class="fa fa-sticky-note" aria-hidden="true"></i>
                    </span>
                    Info
                </p>
            </header>
            <div class="card-content">
                <div class="control is-grouped">
                    <p>Stato: <a class="has-text-link">bozza</a></p> <br>
                    <p>Visibilità: <a class="has-text-link">privato</a></p> <br>
                    <p>Ultimo salvataggio: <a class="has-text-link">mai</a></p> <br>
                </div>
            </div>
        </div>
    </div>
    <div class="body-container">
        <div class="card">
            <p class="title">
                <span class="icon is-small is-left">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </span>
                Aggiungi un nuovo articolo
            </p>
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input"  type="text" placeholder="Titolo dell'articolo" required>
                    <span class="icon is-small is-left">
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                    </span>
                </p>
            </div>
            <p class="subtitle">
                Carica/Inserisci <span class=".small-bold-text"> (in formato .pdf) </span>
            </p>

            <label for="upload"> <i class='fas fa-file-alt'> Carica il tuo file </i></label>
            <input type="file" id="upload" name="articleFile">
            
            <div class="field">
                <script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
                <script type="text/javascript">
                    bkLib.onDomLoaded(function() { nicEditors.allTextAreas()});
                </script>
                <p class="control">
                    <textarea class="textarea" placeholder="Descrizione dell'articolo" required></textarea>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>