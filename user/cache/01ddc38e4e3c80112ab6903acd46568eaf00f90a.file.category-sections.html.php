<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/category-sections.html" */ ?>
<?php /*%%SmartyHeaderCode:1528427241602d1b9f7544b1-16440084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01ddc38e4e3c80112ab6903acd46568eaf00f90a' => 
    array (
      0 => 'themes/default/category-sections.html',
      1 => 1458300816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1528427241602d1b9f7544b1-16440084',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_display_sections_categories' => 0,
    'theme_sections_categories' => 0,
    'sections' => 0,
    'lang_browse_all' => 0,
    'theme_sections_content_style' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f780123_75870775',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f780123_75870775')) {function content_602d1b9f780123_75870775($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_selected_categories')) include './plugins/modifier.get_selected_categories.php';
if (!is_callable('smarty_modifier_news_in_category')) include './plugins/modifier.news_in_category.php';
if (!is_callable('smarty_modifier_html_decode')) include './plugins/modifier.html_decode.php';
if (!is_callable('smarty_modifier_slug')) include './plugins/modifier.slug.php';
?><?php if ($_smarty_tpl->tpl_vars['theme_display_sections_categories']->value==1) {?>
<?php  $_smarty_tpl->tpl_vars['sections'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sections']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = smarty_modifier_get_selected_categories($_smarty_tpl->tpl_vars['theme_sections_categories']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sections']->key => $_smarty_tpl->tpl_vars['sections']->value) {
$_smarty_tpl->tpl_vars['sections']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['sections']->key;
?>
<?php if (smarty_modifier_news_in_category($_smarty_tpl->tpl_vars['sections']->value['id'],4)!=0) {?>
<div class="section-box">
<h4 class="heading-font" style="background:<?php echo $_smarty_tpl->tpl_vars['sections']->value['color'];?>
;"><?php echo $_smarty_tpl->tpl_vars['sections']->value['category'];?>
 <a href="./category/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['sections']->value['category']));?>
?cid=<?php echo $_smarty_tpl->tpl_vars['sections']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['lang_browse_all']->value;?>
</a></h4>
<div class="news-section-content">
<?php echo $_smarty_tpl->getSubTemplate ("news-section-style".((string)$_smarty_tpl->tpl_vars['theme_sections_content_style']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
</div>
<?php }?>
<?php } ?>
<?php }?><?php }} ?>
