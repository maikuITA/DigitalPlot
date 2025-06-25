<?php
/* Smarty version 5.5.1, created on 2025-06-25 10:44:25
  from 'file:profilo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685bb6e9b4fb35_41192931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ad8d188d54b3272b2215fec19ebf64eb4dab096' => 
    array (
      0 => 'profilo.tpl',
      1 => 1750840929,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685bb6e9b4fb35_41192931 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/membri/digitalplot/Progetto/Smarty/templates';
?><!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Profilo</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/profilo.css">
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
                    <?php if ($_smarty_tpl->getValue('isLogged') === true) {?>
                        <a class="navbar-item">PlotPoints: <?php echo $_smarty_tpl->getValue('plotPoints');?>
</a>
                        <?php if ($_smarty_tpl->getValue('privilege') == 0) {?>
                            <a class="navbar-item" href="/subscribe">Abbonati</a>
                        <?php }?>
                        <?php if ($_smarty_tpl->getValue('privilege') === 3) {?>
                            <a class="navbar-item" href="/dashboard" > Dashboard </a>
                            <a class="navbar-item" href="/logs"> Logs </a>
                        <?php }?>
                    <?php } else { ?>
                        <a class="navbar-item has-text-link transfer" href="/auth">Accedi</a>
                    <?php }?>
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
            <?php if ($_smarty_tpl->getValue('isLogged') === true) {?>
                <?php if ($_smarty_tpl->getValue('privilege') >= 2) {?>
                    <a href="/newArticle" class="is-ok">
                        <span class="icon is-large is-ok">
                            <i class="fa fa-plus-square" style="font-size:24px"></i>
                        </span>
                    </a>
                <?php }?>
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-search lens is-ok" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="/profile"><figure class="image is-48x48">
                    <?php if ($_smarty_tpl->getValue('proPic') === null) {?>
                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png"/>
                    <?php } else { ?>
                        <img class="is-rounded" src="data:image/jpeg;base64,<?php echo $_smarty_tpl->getValue('proPic');?>
"/>
                    <?php }?>
                </figure></a>
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-sign-out is-ok" aria-hidden="true"></i>
                    </span>
                </a>
            <?php } else { ?>
                <a href="/auth" class="button is-warning ok">Accedi</a>
            <?php }?>
        </div>
    </header>
    <div class="absolute-left">
        <div class="card yes">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon is-small is-left">
                        <i class="fa fa-hashtag" aria-hidden="true"></i>
                    </span>
                    Collegamenti
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <table class="fixed">
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#profile" class="has-text-link">Profilo</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#articles" class="has-text-link">Articoli</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                </span>
                                <a href="#readings" class="has-text-link">Letture</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="body-container">
        <div class="card">
            <div class="columns">
                <div class="column is-one-fifth">
                        <figure class="image is-128x128">
                                <form id="avatarForm" action="/uploadAvatar" method="POST" enctype="multipart/form-data">
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                                    <?php if ($_smarty_tpl->getValue('proPic') === null) {?>
                                            <label for="avatarInput" class="avatar-wrapper">
                                                <img src="/Progetto/Smarty/img/propic.png" alt="Foto profilo" id="avatarPreview" class="profilePictureU">
                                                <i class="fas fa-camera camera-icon"></i>
                                            </label>
                                    <?php } else { ?>
                                        <label for="avatarInput" class="avatar-wrapper">
                                            <img class="is-rounded" src="data:image/jpeg;base64,<?php echo $_smarty_tpl->getValue('proPic');?>
" id="avatarPreview" class="profilePictureU"/>
                                        </label>
                                    <?php }?>  
                                </form>
                        </figure>
                    </form>
                </div>
                <div class="column is-two-fifth c">
                    <a class="title"><?php echo $_smarty_tpl->getValue('user')->getUsername();?>
</a>
                    <?php if ($_smarty_tpl->getValue('user')->getPrivilege() === 0) {?>
                        <a class="subtitle has-text-warning">Utente base</a>
                    <?php } elseif ($_smarty_tpl->getValue('user')->getPrivilege() === 1) {?>
                        <a class="subtitle has-text-warning">Utente reader</a>
                    <?php } elseif ($_smarty_tpl->getValue('user')->getPrivilege() === 2) {?>
                        <a class="subtitle has-text-warning">Utente writer</a>
                    <?php } elseif ($_smarty_tpl->getValue('user')->getPrivilege() === 3) {?>
                        <a class="subtitle has-text-warning">Amministratore</a>
                    <?php }?>

                </div>
                <div class="column is-two-fifth cs">
                    <div class="is-gapped">
                        <a class="is-5 s">Follower</a><a class="is-5"><?php echo $_smarty_tpl->getValue('user')->getNumFollowers();?>
</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Seguiti</a><a class="is-5"><?php echo $_smarty_tpl->getValue('user')->getNumFollowing();?>
</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Articoli scritti</a><a class="is-5"><?php echo $_smarty_tpl->getValue('user')->getNumArticles();?>
</a>
                    </div>
                    <div class="is-gapped">
                        <a class="is-5 s">Articoli letti</a><a class="is-5"><?php echo $_smarty_tpl->getValue('user')->countReadings();?>
</a>
                    </div>
                </div>
            </div>
            <div> <p class="is-5 s"> Biografia </p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sagittis augue in nibh porta interdum. Sed eu ex et felis sollicitudin pulvinar. </div>
        </div>
        <div class="card articles" id="articles">
            <table class="table is-striped is-hoverable">
                <caption class="title">Articoli caricati</caption>
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Stato</th>
                        <th>Data pubblicazione</th>
                        <th>Genere</th>
                        <th>Modifica</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ((true && ($_smarty_tpl->hasVariable('articles') && null !== ($_smarty_tpl->getValue('articles') ?? null)))) {?>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('articles'), 'article');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('article')->value) {
$foreach0DoElse = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getValue('article')->getTitle();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getState();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getReleaseDate()->format('Y-m-d');?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getGenre();?>
</td>
                                <td><a class="has-text-link" href="/modifyArticle/<?php echo $_smarty_tpl->getValue('article')->getId();?>
" >Modifica</a></td>
                                <td><a class="has-text-danger" href="/dropArticle/<?php echo $_smarty_tpl->getValue('article')->getId();?>
"> Elimina</a></td>
                            </tr>           
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="card articles">
            <table class="table is-striped is-hoverable" id="readings">
                <caption class="title">Articoli letti</caption>
                <thead>
                    <tr>
                        <th>Nome articolo</th>
                        <th>Data pubblicazione</th>
                        <th>Categoria</th>
                        <th>Genere</th>
                        <th>Leggi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ((true && ($_smarty_tpl->hasVariable('readdenArticles') && null !== ($_smarty_tpl->getValue('readdenArticles') ?? null)))) {?>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('readdenArticles'), 'article');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('article')->value) {
$foreach1DoElse = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getValue('article')->getTitle();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getReleaseDate()->format('Y-m-d');?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getCategory();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('article')->getGenre();?>
</td>
                                <td><a class="has-text-link" href="/article/<?php echo $_smarty_tpl->getValue('article')->getId();?>
" >Leggi</a></td>
                            </tr>           
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                <?php }?>    
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>
<?php echo '<script'; ?>
 src="/Progetto/Smarty/js/navburger.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Progetto/Smarty/js/profile.js"><?php echo '</script'; ?>
><?php }
}
