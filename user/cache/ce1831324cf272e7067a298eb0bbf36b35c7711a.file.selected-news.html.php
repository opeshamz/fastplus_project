<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/selected-news.html" */ ?>
<?php /*%%SmartyHeaderCode:1493811376602d1b9f7868c9-40251799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce1831324cf272e7067a298eb0bbf36b35c7711a' => 
    array (
      0 => 'themes/default/selected-news.html',
      1 => 1458303688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1493811376602d1b9f7868c9-40251799',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang_recently_added' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f7b0b77_41588607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f7b0b77_41588607')) {function content_602d1b9f7b0b77_41588607($_smarty_tpl) {?><div class="section-box" id="section-news">
<h4 class="heading-font margin-bottom"><?php echo $_smarty_tpl->tpl_vars['lang_recently_added']->value;?>
</h4>
<div id="selected-news"></div>
</div>

<?php echo '<script'; ?>
>
$(document).ready(function(){
$.get("ajax.php?case=ajax_news_next_prev", { "page": 1 }, function(result){
$('#selected-news').html(result);
});	
});
<?php echo '</script'; ?>
>
<?php }} ?>
