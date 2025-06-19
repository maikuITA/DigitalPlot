<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Lettura</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/lettura.css">
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
                    <a class="navbar-item" href="index.html">Home</a>
                    <a class="navbar-item" href="abbonati.html">Abbonati</a>
                    <a class="navbar-item has-text-link transfer" href="accesso.html">Accedi</a>
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
            <a href="accesso.html" class="button is-warning ok">Accedi</a>
        </div>
    </header>
    <div class="body-container">
        <div class="card text">
            <div class="card-content">
                <div class="content">
                    <p class="title">Lorem ipsum dolor sit amet</p>
                    <p class="subtitle">consectetur adipiscing elit. In sagittis justo sit amet libero dapibus, ac tempus sem iaculis. Morbi magna massa, consequat at blandit sed, vehicula ac lectus. Donec lobortis dictum magna, id iaculis dolor mollis a. Nulla rhoncus, libero quis posuere dictum, nisl leo bibendum justo, nec ornare nibh dui at felis. Nulla viverra nibh et lectus vehicula lacinia. Morbi finibus ex in blandit ultrices. Duis scelerisque, nulla eget placerat rhoncus, tellus metus iaculis tortor, non scelerisque diam ante eget nunc. Donec congue eros dolor, eu sollicitudin eros placerat a. Praesent mollis congue elit, sit amet finibus massa suscipit vel. Praesent vitae efficitur ex. Vivamus consequat, arcu vitae tincidunt vehicula, ipsum ipsum congue ligula, eu venenatis odio tortor at magna. Phasellus fringilla tempor tempus. Curabitur vulputate neque lorem, vel dapibus dolor pretium a.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <figure class="image is-4by3">
                <img
                    src="https://bulma.io/assets/images/placeholders/1280x960.png"
                    alt="Placeholder image"
                />
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                    <img
                        src="https://bulma.io/assets/images/placeholders/96x96.png"
                        alt="Placeholder image"
                    />
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">John Smith</p>
                    <p class="subtitle is-6">@johnsmith</p>
                </div>
                </div>

                <div class="content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
                iaculis mauris. <a>@bulmaio</a>. <a href="#">#css</a>
                <a href="#">#responsive</a>
                <br />
                <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="navburger.js"></script>