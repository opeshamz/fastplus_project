<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/archive-widget.html" */ ?>
<?php /*%%SmartyHeaderCode:1438913511602d1b9f8027b2-06414125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aee8f578c039e73a753aeca10408011f17b35abf' => 
    array (
      0 => 'themes/default/archive-widget.html',
      1 => 1458314074,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1438913511602d1b9f8027b2-06414125',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_display_archive_widget' => 0,
    'theme_mobile_archive_widget' => 0,
    'theme_tab_archive_widget' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f80b735_60603949',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f80b735_60603949')) {function content_602d1b9f80b735_60603949($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['theme_display_archive_widget']->value==1) {?>
<div class="panel panel-default calendar <?php if ($_smarty_tpl->tpl_vars['theme_mobile_archive_widget']->value==0) {?>hidden-xs<?php }?> <?php if ($_smarty_tpl->tpl_vars['theme_tab_archive_widget']->value==0) {?>hidden-sm<?php }?>"></div>
<?php }?>

<?php }} ?>
