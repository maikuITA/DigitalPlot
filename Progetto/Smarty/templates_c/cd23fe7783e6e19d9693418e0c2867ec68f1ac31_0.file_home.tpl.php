<?php
/* Smarty version 5.4.3, created on 2025-03-20 10:53:15
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67dbe58b28abe4_44040755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd23fe7783e6e19d9693418e0c2867ec68f1ac31' => 
    array (
      0 => 'home.tpl',
      1 => 1742399536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67dbe58b28abe4_44040755 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/opt/lampp/htdocs/provasmarty/Progetto/Smarty/templates';
?><!DOCTYPE html>
<html>
<head>
    <title>Prova Smarty</title>
</head>
<body>
    <h1><?php echo $_smarty_tpl->getValue('saluto');?>
</h1>
    <p>Oggi è <?php echo $_smarty_tpl->getValue('giorno');?>
.</p>
</body>
</html><?php }
}
