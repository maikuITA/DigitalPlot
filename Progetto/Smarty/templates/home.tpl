<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Home</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
                    {if $isLogged === true}
                        <a class="navbar-item" href="">PlotPoints: {$plotPoints}</a>
                    {else}
                        <a class="navbar-item has-text-link transfer" href="/accesso">Accedi</a>
                    {/if}
                </div>
            </div>
        </div>
        <div class="column">
            <div>
                <a href="#" class="title is-1">Digital</a>
                <a href="#" class="title is-1 has-text-warning">Plot</a>
            </div> 
        </div>
        <div class="column is-one-quarter right">
            {if $isLogged === true}
                <a href="/cerca">
                    <span class="icon is-large">
                        <i class="fa fa-search lens" aria-hidden="true"></i>
                    </span>
                </a>
                <figure class="image is-48x48">
                    {if $proPic === null}
                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png"/>
                    {else}
                        <img class="is-rounded src="data:image/jpeg;base64,{$proPic}"/>
                    {/if}
                </figure>
            {else}
                <a href="/accesso" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="container">
        <label class="title is-3">
            {if $isLogged === true}
                Scelti per {$username}
            {else}
                Scelti per te
            {/if}
        </label>
    </div>
    <div class="container" id="container">
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">Leggi di più</a>
                </p>
            </footer>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>