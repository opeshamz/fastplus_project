<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/index.html" */ ?>
<?php /*%%SmartyHeaderCode:2144532691602d1b9f676ea8-15227528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba64cb4cc359177dfc4c1252ab1b5367f7813a0d' => 
    array (
      0 => 'themes/default/index.html',
      1 => 1458221892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2144532691602d1b9f676ea8-15227528',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f6ca4d6_58905615',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f6ca4d6_58905615')) {function content_602d1b9f6ca4d6_58905615($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_ad')) include './plugins/modifier.get_ad.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="row">
<div class="col-md-8 the-body">
<?php echo $_smarty_tpl->getSubTemplate ("category-sections.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo smarty_modifier_get_ad('content_1',1);?>

<?php echo $_smarty_tpl->getSubTemplate ("selected-news.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo smarty_modifier_get_ad('content_2',1);?>

</div>
<div class="col-md-4 sidebar">
<?php echo $_smarty_tpl->getSubTemplate ("sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
