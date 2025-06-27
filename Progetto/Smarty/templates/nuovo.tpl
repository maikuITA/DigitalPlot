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
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                        {if $privilege eq 0}
                            <a class="navbar-item" href="/subscribe">Abbonati</a>
                        {/if}
                        {if $privilege >= 2}
                            <hr class="navbar-divider">
                            <a class="navbar-item" id="new_mobile" href="/newArticle">Nuovo articolo</a>
                            <a class="navbar-item" id="new_find" href="/find">Ricerca</a>
                        {/if}
                        {if $privilege === 3}
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="/dashboard" > Dashboard </a>
                            <a class="navbar-item" href="/logs"> Logs </a>
                        {/if}
                        <hr class="navbar-divider">
                        <a class="navbar-item" id="new_logout" href="/logout">Logout</a>
                        <hr class="navbar-divider">
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
            {if $modify === false}
                <form id="form-articolo" method="POST" action="/saveArticle" enctype="multipart/form-data">
            {else}
                <form id="form-articolo" method="POST" action="/saveUpdate/{$article->getId()}" enctype="multipart/form-data">
            {/if}
                <p class="title">
                    <span class="icon is-small is-left">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </span>
                    Aggiungi un nuovo articolo
                </p>
                <div class="field">
                    {if $modify === false}
                        <p class="control has-icons-left has-icons-right">
                            <input class="input"  type="text" name="title" placeholder="Titolo dell'articolo" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </span>
                        </p>
                    {else}
                        <p class="control has-icons-left has-icons-right">
                            <input class="input"  type="text" name="title" value="{$article->getTitle()|escape:'htmlall':'UTF-8'}" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </span>
                        </p>
                    {/if}
                </div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        {if $modify === false}
                            <input class="input"  type="text" name="description" placeholder="Descrizione dell'articolo" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </span>
                        {else}
                            <input class="input"  type="text" name="description" value="{$article->getDescription()|escape:'htmlall':'UTF-8'}" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </span>
                            <span class="icon is-small is-right">
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                            </span>
                        {/if}
                    </p>
                </div>

                <div class="select-container">
                        {if $modify === true}
                            <div class="select is-rounded">
                                <select name="category" required>
                                    <option value="" disabled {if $article->getCategory() === ""}selected{/if}>Categorie</option>
                                    <option value="articolo" {if $article->getCategory() === 'articolo'}selected{/if}>Articolo</option>
                                    <option value="giornale" {if $article->getCategory() === 'giornale'}selected{/if}>Giornale</option>
                                    <option value="rivista" {if $article->getCategory() === 'rivista'}selected{/if}>Rivista</option>
                                    <option value="romanzo" {if $article->getCategory() === 'romanzo'}selected{/if}>Romanzo</option>
                                    <option value="racconto" {if $article->getCategory() === 'racconto'}selected{/if}>Racconto</option>
                                    <option value="saggio" {if $article->getCategory() === 'saggio'}selected{/if}>Saggio</option>
                                    <option value="blog" {if $article->getCategory() === 'blog'}selected{/if}>Blog</option>
                                    <option value="notizia" {if $article->getCategory() === 'notizia'}selected{/if}>Notizia</option>
                                    <option value="editoriale" {if $article->getCategory() === 'editoriale'}selected{/if}>Editoriale</option>
                                    <option value="recensione" {if $article->getCategory() === 'recensione'}selected{/if}>Recensione</option>
                                    <option value="intervista" {if $article->getCategory() === 'intervista'}selected{/if}>Intervista</option>
                                    <option value="manuale" {if $article->getCategory() === 'manuale'}selected{/if}>Manuale</option>
                                    <option value="tesi" {if $article->getCategory() === 'tesi'}selected{/if}>Tesi</option>
                                    <option value="fumetto" {if $article->getCategory() === 'fumetto'}selected{/if}>Fumetto</option>
                                    <option value="pamphlet" {if $article->getCategory() === 'pamphlet'}selected{/if}>Pamphlet</option>
                                    <option value="biografia" {if $article->getCategory() === 'biografia'}selected{/if}>Biografia</option>
                                    <option value="autobiografia" {if $article->getCategory() === 'autobiografia'}selected{/if}>Autobiografia</option>
                                    <option value="poesia" {if $article->getCategory() === 'poesia'}selected{/if}>Poesia</option>
                                    <option value="dramma" {if $article->getCategory() === 'dramma'}selected{/if}>Dramma</option>
                                </select>
                            </div>


                            <div class="select is-rounded ml-4">
                                <select name="genre" required>
                                    <option value="" disabled {if $article->getGenre() === ""}selected{/if}>Genere</option>
                                    <option value="cronaca" {if $article->getGenre() === 'cronaca'}selected{/if}>Cronaca</option>
                                    <option value="politica" {if $article->getGenre() === 'politica'}selected{/if}>Politica</option>
                                    <option value="economia" {if $article->getGenre() === 'economia'}selected{/if}>Economia</option>
                                    <option value="esteri" {if $article->getGenre() === 'esteri'}selected{/if}>Esteri</option>
                                    <option value="interni" {if $article->getGenre() === 'interni'}selected{/if}>Interni</option>
                                    <option value="cultura" {if $article->getGenre() === 'cultura'}selected{/if}>Cultura</option>
                                    <option value="spettacolo" {if $article->getGenre() === 'spettacolo'}selected{/if}>Spettacolo</option>
                                    <option value="sport" {if $article->getGenre() === 'sport'}selected{/if}>Sport</option>
                                    <option value="tecnologia" {if $article->getGenre() === 'tecnologia'}selected{/if}>Tecnologia</option>
                                    <option value="scienza" {if $article->getGenre() === 'scienza'}selected{/if}>Scienza</option>
                                    <option value="ambiente" {if $article->getGenre() === 'ambiente'}selected{/if}>Ambiente</option>
                                    <option value="salute" {if $article->getGenre() === 'salute'}selected{/if}>Salute</option>
                                    <option value="viaggi" {if $article->getGenre() === 'viaggi'}selected{/if}>Viaggi</option>
                                    <option value="motori" {if $article->getGenre() === 'motori'}selected{/if}>Motori</option>
                                    <option value="lifestyle" {if $article->getGenre() === 'lifestyle'}selected{/if}>Lifestyle</option>
                                    <option value="moda" {if $article->getGenre() === 'moda'}selected{/if}>Moda</option>
                                    <option value="gastronomia" {if $article->getGenre() === 'gastronomia'}selected{/if}>Gastronomia</option>
                                    <option value="religione" {if $article->getGenre() === 'religione'}selected{/if}>Religione</option>
                                    <option value="istruzione" {if $article->getGenre() === 'istruzione'}selected{/if}>Istruzione</option>
                                    <option value="diritti" {if $article->getGenre() === 'diritti'}selected{/if}>Diritti</option>
                                    <option value="giustizia" {if $article->getGenre() === 'giustizia'}selected{/if}>Giustizia</option>
                                    <option value="gossip" {if $article->getGenre() === 'gossip'}selected{/if}>Gossip</option>
                                    <option value="musica" {if $article->getGenre() === 'musica'}selected{/if}>Musica</option>
                                    <option value="cinema" {if $article->getGenre() === 'cinema'}selected{/if}>Cinema</option>
                                    <option value="libri" {if $article->getGenre() === 'libri'}selected{/if}>Libri</option>
                                    <option value="classico" {if $article->getGenre() === 'classico'}selected{/if}>Classico</option>
                                </select>
                            </div>
                        {else}
                            <div class="select is-rounded">
                                <select name="category" required>
                                    <option value="" disabled selected>Categorie</option>
                                    <option value="articolo" >Articolo</option>
                                    <option value="giornale" >Giornale</option>
                                    <option value="rivista" >Rivista</option>
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


                            <div class="select is-rounded ml-4">
                                <select name="genre" required>
                                    <option value="" disabled selected>Genere</option>
                                    <option value="cronaca">Cronaca</option>
                                    <option value="politica">Politica</option>
                                    <option value="economia">Economia</option>
                                    <option value="esteri" >Esteri</option>
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
                                    <option value="libri" >Libri</option>
                                    <option value="classico">Classico</option>
                                </select>
                            </div>
                        {/if}
                </div>
                <div class="block-container mt-4 mb-4">
                    {if $modify === false}
                        <div id="editor-container"></div>
                        <input type="hidden" name="contenuto" id="contenuto-articolo">
                    {else}
                        <div id="editor-container"> {if $article->getHtmlContent()}{$article->getHtmlContent() nofilter}{/if}</div>
                        <input type="hidden" name="contenuto" id="contenuto-articolo">
                    {/if}
                </div>
                <p class="subtitle"> oppure </p> 
                <div class="flex-container">
                    <p>Carica/Inserisci <span> (in formato .txt)</span> </p>
                    <label for="upload" class="custom-file-label">
                        <i class="fa fa-file-upload" aria-hidden="true"></i><p> Carica il tuo file </p> 
                    </label>
                    <input type="file" id="upload" name="articleFile" style="display:none;">
                    <div id="fileStatus"></div>
                </div>
                <div class="card gruppo mt-6">
                    <div class="field is-grouped is-centered">
                    <p class="control has-icons-left confirm">
                        <button class="button is-link is-rounded is-fullwidth is-outlined" type="submit">Conferma</button>
                        <span class="icon is-small is-left has-text-link">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </span>
                    </p>
                    <p class="control has-icons-left confirm">
                        <button class="button is-danger is-rounded is-fullwidth is-outlined" type="reset">Annulla</button>
                        <span class="icon is-small is-left has-text-danger">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </span>
                    </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="/Progetto/Smarty/js/textEditor.js"></script>
<script src="/Progetto/Smarty/js/uploadFile.js"></script>
<script src="/Progetto/Smarty/js/uploadArticle.js"></script>
{if $modify === true}
    
    <script>
        const initialContent ="{$content|escape:'js'}";

        quill.root.innerHTML = initialContent;
    </script>
    
{/if}


