<?php
/* Smarty version 5.4.3, created on 2025-03-19 15:15:16
  from 'file:prova.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67dadf84883606_89613958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8543d34a0ae4356c89366f796d9b361282c4d542' => 
    array (
      0 => 'prova.tpl',
      1 => 1742395847,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67dadf84883606_89613958 (\Smarty\Template $_smarty_tpl) {
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
