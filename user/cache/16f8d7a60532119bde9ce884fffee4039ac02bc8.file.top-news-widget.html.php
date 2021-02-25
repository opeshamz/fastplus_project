<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/top-news-widget.html" */ ?>
<?php /*%%SmartyHeaderCode:1283086883602d1b9f7d7473-00579673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16f8d7a60532119bde9ce884fffee4039ac02bc8' => 
    array (
      0 => 'themes/default/top-news-widget.html',
      1 => 1458486474,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1283086883602d1b9f7d7473-00579673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_display_top_news_widget' => 0,
    'theme_mobile_topnews_widget' => 0,
    'theme_tab_topnews_widget' => 0,
    'top' => 0,
    'theme_allow_lazyload' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f8002c2_28144340',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f8002c2_28144340')) {function content_602d1b9f8002c2_28144340($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_html_decode')) include './plugins/modifier.html_decode.php';
if (!is_callable('smarty_modifier_slug')) include './plugins/modifier.slug.php';
if (!is_callable('smarty_function_counter')) include './include/smarty/plugins/function.counter.php';
if (!is_callable('smarty_modifier_article_thumbnail')) include './plugins/modifier.article_thumbnail.php';
?><?php if ($_smarty_tpl->tpl_vars['theme_display_top_news_widget']->value==1) {?>
<div class="row <?php if ($_smarty_tpl->tpl_vars['theme_mobile_topnews_widget']->value==0) {?>hidden-xs<?php }?> <?php if ($_smarty_tpl->tpl_vars['theme_tab_topnews_widget']->value==0) {?>hidden-sm<?php }?>">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['top']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['x']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['x']['total']);
?>
<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
<div class="single-trending-item-image">
<a href="./news/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']));?>
?uid=<?php echo $_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" title="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
">
<div class="overlay-image max-width">
<span class="trending-number">
<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['x']['first']) {
echo smarty_function_counter(array('start'=>1,'skip'=>1),$_smarty_tpl);
} else {
echo smarty_function_counter(array(),$_smarty_tpl);
}?>
</span>
<img <?php if ($_smarty_tpl->tpl_vars['theme_allow_lazyload']->value==1) {?>data-<?php }?>src="<?php echo smarty_modifier_article_thumbnail($_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['thumbnail'],$_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['source_id']);?>
" class="img-responsive" alt="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
" />
</div>
<div class="single-trending-item-title heading-font"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['top']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
</div>
</a>
</div>
</div>
<?php endfor; endif; ?>
</div>
<?php }?>

<?php }} ?>
