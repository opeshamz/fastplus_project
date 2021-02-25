<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:796320992602d1b9f7b4379-79179571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94a376e062cc5e80c131d4de6a96c7a909d80688' => 
    array (
      0 => 'themes/default/sidebar.html',
      1 => 1448501416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '796320992602d1b9f7b4379-79179571',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f7c3569_31899645',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f7c3569_31899645')) {function content_602d1b9f7c3569_31899645($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_ad')) include './plugins/modifier.get_ad.php';
?><?php echo $_smarty_tpl->getSubTemplate ("weather-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo smarty_modifier_get_ad('sidebar_1',1);?>

<?php echo $_smarty_tpl->getSubTemplate ("top-news-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("archive-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("poll-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("social-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo smarty_modifier_get_ad('sidebar_2',1,1);?>

<?php }} ?>
