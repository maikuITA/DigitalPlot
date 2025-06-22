<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Ricerca</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/ricerca.css">
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
                    Inserisci il titolo dell'articolo che desideri leggere.
                    Oppure, se preferisci, puoi utilizzare i filtri per categoria, genere e data di pubblicazione per affinare la ricerca.
                </p>
                <form class="field is-grouped" method="POST" action="/search">
                    <div class="control has-icons-left" >
                        <input class="input is-rounded" type="text" placeholder="Titolo..." name="title">
                        <span class="icon is-small is-left has-link">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="select is-rounded">
                        <select name="category">
                            <option value="%">Categorie</option>
                            <option value="articolo">Articolo</option>
                            <option value="giornale">Giornale</option>
                            <option value="rivista">Rivista</option>
                            <option value="romanzo">Romanzo</option>
                            <option value="racconto">Racconto</option>
                            <option value="saggio">Saggio</option>
                            <option value="blog">Blog</option>
                            <option value="notizia">Notizia</option>
                            <option value="editoriale">Editoriale</option>
                            <option value="recensione">Recensione</option>
                            <option value="intervista">Intervista</option>
                            <option value="manuale">Manuale</option>
                            <option value="tesi">Tesi</option>
                            <option value="fumetto">Fumetto</option>
                            <option value="pamphlet">Pamphlet</option>
                            <option value="biografia">Biografia</option>
                            <option value="autobiografia">Autobiografia</option>
                            <option value="poesia">Poesia</option>
                            <option value="dramma">Dramma</option>
                        </select>
                    </div>
                    <div class="select is-rounded">
                        <select name="genre">
                            <option value="%">Genere</option>
                            <option value="cronaca">Cronaca</option>
                            <option value="politica">Politica</option>
                            <option value="economia">Economia</option>
                            <option value="esteri">Esteri</option>
                            <option value="interni">Interni</option>
                            <option value="cultura">Cultura</option>
                            <option value="spettacolo">Spettacolo</option>
                            <option value="sport">Sport</option>
                            <option value="tecnologia">Tecnologia</option>
                            <option value="scienza">Scienza</option>
                            <option value="ambiente">Ambiente</option>
                            <option value="salute">Salute</option>
                            <option value="viaggi">Viaggi</option>
                            <option value="motori">Motori</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="moda">Moda</option>
                            <option value="gastronomia">Gastronomia</option>
                            <option value="religione">Religione</option>
                            <option value="istruzione">Istruzione</option>
                            <option value="diritti">Diritti</option>
                            <option value="giustizia">Giustizia</option>
                            <option value="gossip">Gossip</option>
                            <option value="musica">Musica</option>
                            <option value="cinema">Cinema</option>
                            <option value="libri">Libri</option>
                        </select>

                    </div>
                    <div class="select is-rounded">
                        <select name="releaseDate">
                            <option value="1000-01-01">Anno</option>
                            <option value="2025-01-01">2025</option>
                            <option value="2020-01-01">2020</option>
                            <option value="2015-01-01">2015</option>
                            <option value="2010-01-01">2010</option>
                            <option value="2005-01-01">2005</option>
                            <option value="2000-01-01">2000</option>
                            <option value="1995-01-01">1995</option>
                            <option value="1990-01-01">1990</option>
                            <option value="1985-01-01">1985</option>
                            <option value="1980-01-01">1980</option>
                            <option value="1975-01-01">1975</option>
                            <option value="1970-01-01">1970</option>
                            <option value="1965-01-01">1965</option>
                            <option value="1960-01-01">1960</option>
                            <option value="1955-01-01">1955</option>
                            <option value="1950-01-01">1950</option>
                            <option value="1945-01-01">1945</option>
                            <option value="1940-01-01">1940</option>
                            <option value="1935-01-01">1935</option>
                            <option value="1930-01-01">1930</option>
                            <option value="1925-01-01">1925</option>
                            <option value="1920-01-01">1920</option>
                            <option value="1915-01-01">1915</option>
                            <option value="1910-01-01">1910</option>
                            <option value="1905-01-01">1905</option>
                            <option value="1900-01-01">1900</option>
                            <option value="1895-01-01">1895</option>
                            <option value="1890-01-01">1890</option>
                            <option value="1885-01-01">1885</option>
                            <option value="1880-01-01">1880</option>
                            <option value="1875-01-01">1875</option>
                            <option value="1870-01-01">1870</option>
                            <option value="1865-01-01">1865</option>
                            <option value="1860-01-01">1860</option>
                            <option value="1855-01-01">1855</option>
                            <option value="1850-01-01">1850</option>
                            <option value="1845-01-01">1845</option>
                            <option value="1840-01-01">1840</option>
                            <option value="1835-01-01">1835</option>
                            <option value="1830-01-01">1830</option>
                            <option value="1825-01-01">1825</option>
                            <option value="1820-01-01">1820</option>
                            <option value="1815-01-01">1815</option>
                            <option value="1810-01-01">1810</option>
                            <option value="1805-01-01">1805</option>
                            <option value="1800-01-01">1800</option>
                            <option value="1795-01-01">1795</option>
                            <option value="1790-01-01">1790</option>
                            <option value="1785-01-01">1785</option>
                            <option value="1780-01-01">1780</option>
                            <option value="1775-01-01">1775</option>
                            <option value="1770-01-01">1770</option>
                            <option value="1765-01-01">1765</option>
                            <option value="1760-01-01">1760</option>
                            <option value="1755-01-01">1755</option>
                            <option value="1750-01-01">1750</option>
                            <option value="1745-01-01">1745</option>
                            <option value="1740-01-01">1740</option>
                            <option value="1735-01-01">1735</option>
                            <option value="1730-01-01">1730</option>
                            <option value="1725-01-01">1725</option>
                            <option value="1720-01-01">1720</option>
                            <option value="1715-01-01">1715</option>
                            <option value="1710-01-01">1710</option>
                            <option value="1705-01-01">1705</option>
                            <option value="1700-01-01">1700</option>
                            <option value="1695-01-01">1695</option>
                            <option value="1690-01-01">1690</option>
                            <option value="1685-01-01">1685</option>
                            <option value="1680-01-01">1680</option>
                            <option value="1675-01-01">1675</option>
                            <option value="1670-01-01">1670</option>
                            <option value="1665-01-01">1665</option>
                            <option value="1660-01-01">1660</option>
                            <option value="1655-01-01">1655</option>
                            <option value="1650-01-01">1650</option>
                            <option value="1645-01-01">1645</option>
                            <option value="1640-01-01">1640</option>
                            <option value="1635-01-01">1635</option>
                            <option value="1630-01-01">1630</option>
                            <option value="1625-01-01">1625</option>
                            <option value="1620-01-01">1620</option>
                            <option value="1615-01-01">1615</option>
                            <option value="1610-01-01">1610</option>
                            <option value="1605-01-01">1605</option>
                            <option value="1600-01-01">1600</option>
                            <option value="1595-01-01">1595</option>
                            <option value="1590-01-01">1590</option>
                            <option value="1585-01-01">1585</option>
                            <option value="1580-01-01">1580</option>
                            <option value="1575-01-01">1575</option>
                            <option value="1570-01-01">1570</option>
                            <option value="1565-01-01">1565</option>
                            <option value="1560-01-01">1560</option>
                            <option value="1555-01-01">1555</option>
                            <option value="1550-01-01">1550</option>
                            <option value="1545-01-01">1545</option>
                            <option value="1540-01-01">1540</option>
                            <option value="1535-01-01">1535</option>
                            <option value="1530-01-01">1530</option>
                            <option value="1525-01-01">1525</option>
                            <option value="1520-01-01">1520</option>
                            <option value="1515-01-01">1515</option>
                            <option value="1510-01-01">1510</option>
                            <option value="1505-01-01">1505</option>
                            <option value="1500-01-01">1500</option>
                            <option value="1495-01-01">1495</option>
                            <option value="1490-01-01">1490</option>
                            <option value="1485-01-01">1485</option>
                            <option value="1480-01-01">1480</option>
                            <option value="1475-01-01">1475</option>
                            <option value="1470-01-01">1470</option>
                            <option value="1465-01-01">1465</option>
                            <option value="1460-01-01">1460</option>
                            <option value="1455-01-01">1455</option>
                            <option value="1450-01-01">1450</option>
                            <option value="1445-01-01">1445</option>
                            <option value="1440-01-01">1440</option>
                            <option value="1435-01-01">1435</option>
                            <option value="1430-01-01">1430</option>
                            <option value="1425-01-01">1425</option>
                            <option value="1420-01-01">1420</option>
                            <option value="1415-01-01">1415</option>
                            <option value="1410-01-01">1410</option>
                            <option value="1405-01-01">1405</option>
                            <option value="1400-01-01">1400</option>
                        </select>
                    </div>
                    <div class="control">
                        <button class="button is-link is-fullwidth is-rounded">Invia</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
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
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>