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
        <div class="card">
            <header class="card-header">
                <p class="card-header-title title">
                    <span class="icon is-medium is-left">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                    Ricerca
                </p>
            </header>
            <section class="section">
                <p class="subtitle">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                </p>
                <div class="field is-grouped">
                    <div class="control has-icons-left" id="email">
                        <input class="input is-rounded" type="text" placeholder="Titolo..." name="titolo">
                        <span class="icon is-small is-left has-link">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="select is-rounded">
                        <select name='type'>
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
                </div>
            </section>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>