<?php
/* Smarty version 5.4.3, created on 2025-04-02 18:37:40
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67ed67d4547706_35848648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c3381c375370c3f0376787f46096c2c7456a2ad' => 
    array (
      0 => 'home.tpl',
      1 => 1743001645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67ed67d4547706_35848648 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/opt/lampp/htdocs/DigitalPlot/Progetto/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>OnlyFans: Homepage</title>
  <link rel="stylesheet" href="Progetto/Smarty/css/index.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Barra superiore unificata -->
  <header class="top-bar">
    <div class="left-section">
      <div class="logo">OnlyFans</div>
      <nav class="main-nav">
        <a href="/">HOMEPAGE</a>
        <a href="/prodotti">PRODOTTI</a>
      </nav>
    </div>
    <div class="right-section">
      <div class="search-box">
        <input type="text" placeholder="Cerca prodotti..." />
        <button>&#128269;</button>
      </div>
    </div>
  </header>

  <!-- Contenuto principale -->
  <div class="main-content">
    <!-- Box Spazio -->
    <div class="box">
      <h2>Spazio</h2>
      <p>Regola lo spazio a seconda delle esigenze del tuo sito.</p>
      <div class="info">SPAZIO UTILIZZATO: 0.72 MB (0.5%)</div>
      <div class="progress-bar-container">
        <div class="progress-bar spazio"></div>
      </div>
      <a class="link" href="#">Gestione File</a>
    </div>

  </div>

</body>
</html>
<?php }
}
