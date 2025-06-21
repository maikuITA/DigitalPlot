<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Abbonati</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/abbonati.css">
    <link href="webfonts/uicons-bold-rounded.css" rel="stylesheet">
    <link href="webfonts/uicons-thin-straight.css" rel="stylesheet">
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
                    {if $isLogged === true}
                        <a class="navbar-item" href="">PlotPoints: {$plotPoints}</a>
                        {if $isAbbonato === false}
                            <a class="navbar-item" href="/subscribe">Abbonati</a>
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
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-search lens is-ok" aria-hidden="true"></i>
                    </span>
                </a>
                <figure class="image is-48x48">
                    {if $proPic === null}
                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png"/>
                    {else}
                        <img class="is-rounded src="data:image/jpeg;base64,{$proPic}"/>
                    {/if}
                </figure>
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
    <div class="container">
        <label class="title is-3">Piani di sottoscrizione</label>
    </div>
    <div class="container" id="container">
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">€XX.XX</a>
                </p>
            </footer>
        </div>
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">€XX.XX</a>
                </p>
            </footer>
        </div>
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">€XX.XX</a>
                </p>
            </footer>
        </div>
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">€XX.XX</a>
                </p>
            </footer>
        </div>
        <div class="card">
            <div class="card-content">
                <p class="title">Lorem ipsum dolor sit amet</p>
                <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus.</p>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                    <a href="#" class="button is-warning">€XX.XX</a>
                </p>
            </footer>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>