<?php
/* Smarty version 5.5.1, created on 2025-06-25 10:44:26
  from 'file:error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685bb6ea396a47_37799457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5cb3b892da327e0c59ae56743e2566ace1e17c2' => 
    array (
      0 => 'error.tpl',
      1 => 1750837992,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685bb6ea396a47_37799457 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/membri/digitalplot/Progetto/Smarty/templates';
?><!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-404</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/error404.css">
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
    <div class="body-container">
        <div class="card">
            <span class="icon is-centered has-text-danger">
                <i class="fa fa-window-close fa-10x" aria-hidden="true"></i>
            </span> 
            <p class="title">
                Errore <br> <?php echo $_smarty_tpl->getValue('errore');?>
 
            </p>
            <a class="subtitle has-text-link" href="/profile">
                Controlla se l'URL è corretto o torna alla home.
            </a>
        </div>
    </div>
</body>
</html>
<?php echo '<script'; ?>
 src="/Progetto/Smarty/js/navburger.js"><?php echo '</script'; ?>
><?php }
}
