<?php
/* Smarty version 5.4.4, created on 2025-06-19 11:59:15
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.4',
  'unifunc' => 'content_6853df732762d9_71827802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13dfa62494f1e50ba5b79be2faaf95aaefb70bfa' => 
    array (
      0 => 'home.tpl',
      1 => 1750327151,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6853df732762d9_71827802 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\DigitalPlot\\Progetto\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Home</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getValue('base_url');?>
bulma<?php echo DIRECTORY_SEPARATOR;?>
bulma.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getValue('base_url');?>
index.css">
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
    <div class="container">
        <label class="title is-3">Scelti per te</label>
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
<?php echo '<script'; ?>
 src="navburger.js"><?php echo '</script'; ?>
><?php }
}
