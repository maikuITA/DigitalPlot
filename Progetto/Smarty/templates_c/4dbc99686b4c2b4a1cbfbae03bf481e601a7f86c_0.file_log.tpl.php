<?php
/* Smarty version 5.5.1, created on 2025-06-25 10:45:46
  from 'file:log.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685bb73a6580f3_97549865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4dbc99686b4c2b4a1cbfbae03bf481e601a7f86c' => 
    array (
      0 => 'log.tpl',
      1 => 1750840929,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685bb73a6580f3_97549865 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/membri/digitalplot/Progetto/Smarty/templates';
?><!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Logs</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/logs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <?php echo '<script'; ?>
 src="/Progetto/Smarty/js/log.js"><?php echo '</script'; ?>
>
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
        <div class="container">
            <label class="title is-3">Logs</label>
        </div>
        <div class="container">
            <div class="card log">
                <div class="card-header">
                    <p class="title">
                        Logs di errore
                    </p>
                </div>
                <div class="card-content">
                    <p class="subtitle" id="contenuto-file-errori"></p>
                </div>
            </div>
            <div class="card log">
                <div class="card-header">
                    <p class="title">Logs di eventi</p>
                </div>
                <div class="card-content">
                    <p class="subtitle" id="contenuto-file-eventi"></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php echo '<script'; ?>
 src="/Progetto/Smarty/js/navburger.js"><?php echo '</script'; ?>
><?php }
}
