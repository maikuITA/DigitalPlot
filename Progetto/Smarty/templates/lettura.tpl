<!DOCTYPE html>
<html lang="it" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigitalPlot-Lettura</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css" />
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css" />
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/lettura.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
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
                <span class="icon is-large is-ok">
                    <i class="fa fa-plus-square" style="font-size: 24px"></i>
                </span>
            </a>
            {/if}
            <a href="/find" class="is-ok">
                <span class="icon is-large is-ok">
                    <i class="fa fa-search lens is-ok" aria-hidden="true"></i>
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
                <span class="icon is-large is-ok">
                    <i class="fa fa-sign-out is-ok" aria-hidden="true"></i>
                </span>
            </a>
            {else}
            <a href="/auth" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="columns is-multiline">
        <div class="column is-three-quarters" id="mario">
            <div class="columns is-multiline" id="franco">
                <div class="column is-full">
                    <div class="card pager author">
                        <div class="media">
                            <div class="media-center">
                                <div class="media-left">
                                    <figure class="image is-48x48">
                                        {if $writerProPic === null}
                                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png" />
                                        {else}
                                        <img class="is-rounded" src="data:image/jpeg;base64,{$writerProPic}" />
                                        {/if}
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <p class="title is-4">
                                        {$writer->getName()}
                                    </p>
                                    <p id="username" class="subtitle is-6">
                                        {$writer->getUsername()}
                                    </p>
                                </div>
                            </div>
                            <div class="media-center">
                                <div class="is-gapped top-right">
                                    <div class="to-center">
                                        <a class="is-5 s has-text-weight-bold">Numero articoli: </a><a
                                            class="is-5">{$writer->getNumArticles()}</a>
                                    </div>
                                    <div class="to-center">
                                        <a class="is-5 s has-text-weight-bold">Follower: </a><a class="is-5"
                                            id="numFollowers">{$writer->getNumFollowers()}</a>
                                    </div>
                                    <div>
                                        <p class="card-footer-item follow-buttons">
                                            <a class="button is-outlined is-link" id="follow">follow</a>
                                            <a class="button is-outlined is-link" id="unfollow">unfollow</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="is-gapped">
                                <a class="is-5 s has-text-weight-bold">Biografia</a><br /><a
                                    class="is-5">{$writer->getBiography()}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-full">
                    <div class="card pager">
                        <div class="content is-centered">
                            <div class="subtitle is-flex is-align-content-space-between" id="eval">
                                <p class="title">{$article->getTitle()}
                                <div class=" is-centered mt-2">
                                    {if $article->getAvgEvaluate() == 0}

                                    {elseif $article->getAvgEvaluate() == 1}
                                    <i class='fas fa-star ml-3'></i>
                                    {elseif $article->getAvgEvaluate() == 2}
                                    <i class='fas fa-star ml-3'></i>
                                    <i class='fas fa-star'></i>
                                    {elseif $article->getAvgEvaluate() == 3}
                                    <i class='fas fa-star ml-3'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    {elseif $article->getAvgEvaluate() == 4}
                                    <i class='fas fa-star ml-3'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    {else}
                                    <i class='fas fa-star ml-3'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    <i class='fas fa-star'></i>
                                    {/if}
                                </div>
                                </p>

                            </div>
                            <p class="subtitle has-text-weight-bold">Descrizione</p>
                            <p class="content">
                                {$article->getDescription()}
                            </p>
                            <p class="subtitle has-text-weight-bold">Categoria</p>
                            <p class="content">
                                {$article->getCategory()}
                            </p>
                            <p class="subtitle has-text-weight-bold">Genere</p>
                            <p class="content">
                                {$article->getGenre()}
                            </p>
                        </div>
                        <div class="content" id="ArticleBody">
                            {$article->getHtmlContent()}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-one-quarter" id="pasquale">
            <div class="card pager">
                <div class="content" id="luca">
                    <p class="title">Commenti</p>
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">
                                Lascia un commento
                            </p>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <form class="form" action="/newReview/{$article->getId()}" method="POST">
                                    <div class="control">
                                        <div class="field">
                                            <textarea class="textarea" name="review" id="c_body"
                                                placeholder="Testo"></textarea>
                                        </div>
                                        <div class="field is-grouped">
                                            <div class="field select is-rounded">
                                                <select name="score" id="c_score">
                                                    <option value="1">
                                                        &#9733;
                                                    </option>
                                                    <option value="2">
                                                        &#9733;&#9733;
                                                    </option>
                                                    <option value="3">
                                                        &#9733;&#9733;&#9733;
                                                    </option>
                                                    <option value="4">
                                                        &#9733;&#9733;&#9733;&#9733;
                                                    </option>
                                                    <option value="5">
                                                        &#9733;&#9733;&#9733;&#9733;&#9733;
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <button class="button is-link" action="submit">
                                                        Invia
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {if isset($reviews)} {foreach from=$reviews item=review}
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">
                                {$review->getSubscriber()->getUsername()}
                            </p>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <p class="subtitle is-6">
                                    {$review->getComment()}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="card-footer-item">
                                {for $i=1 to $review->getEvaluate()} &#9733;
                                {/for}
                            </p>
                        </div>
                    </div>
                    {/foreach} {/if}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="/Progetto/Smarty/js/navburger.js"></script>
<script src="/Progetto/Smarty/js/follow.js"></script>