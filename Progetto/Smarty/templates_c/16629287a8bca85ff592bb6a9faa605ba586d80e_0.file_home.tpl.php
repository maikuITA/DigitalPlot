<?php
/* Smarty version 5.4.3, created on 2025-03-22 12:25:58
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67de9e463b48a8_30870687',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16629287a8bca85ff592bb6a9faa605ba586d80e' => 
    array (
      0 => 'home.tpl',
      1 => 1742642356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67de9e463b48a8_30870687 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\provasmarty\\Progetto\\Smarty\\templates';
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
