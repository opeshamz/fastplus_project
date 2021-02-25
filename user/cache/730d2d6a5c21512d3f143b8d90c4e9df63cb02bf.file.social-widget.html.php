<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/social-widget.html" */ ?>
<?php /*%%SmartyHeaderCode:413806335602d1b9f8241c1-52171972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '730d2d6a5c21512d3f143b8d90c4e9df63cb02bf' => 
    array (
      0 => 'themes/default/social-widget.html',
      1 => 1458314018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '413806335602d1b9f8241c1-52171972',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_display_social_widget' => 0,
    'theme_mobile_social_widget' => 0,
    'theme_tab_social_widget' => 0,
    'lang_social_title' => 0,
    'social_facebook_account' => 0,
    'lang_social_facebook' => 0,
    'social_twitter_account' => 0,
    'lang_social_twitter' => 0,
    'social_google_plus_account' => 0,
    'lang_social_google_plus' => 0,
    'social_youtube_account' => 0,
    'lang_social_youtube' => 0,
    'social_vimeo_account' => 0,
    'lang_social_vimeo' => 0,
    'lang_rss' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f83bb19_45010750',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f83bb19_45010750')) {function content_602d1b9f83bb19_45010750($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['theme_display_social_widget']->value==1) {?>
<div class="widget feedburner <?php if ($_smarty_tpl->tpl_vars['theme_mobile_social_widget']->value==0) {?>hidden-xs<?php }?> <?php if ($_smarty_tpl->tpl_vars['theme_tab_social_widget']->value==0) {?>hidden-sm<?php }?>">
<h4 class="heading-font"><?php echo $_smarty_tpl->tpl_vars['lang_social_title']->value;?>
</h4>
<div class="social-profiles">
<?php if (!empty($_smarty_tpl->tpl_vars['social_facebook_account']->value)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['social_facebook_account']->value;?>
" class="social-profile facebook-profile"><i class="fa fa-facebook fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_social_facebook']->value;?>
</a><?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['social_twitter_account']->value)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['social_twitter_account']->value;?>
" class="social-profile twitter-profile"><i class="fa fa-twitter fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_social_twitter']->value;?>
</a><?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['social_google_plus_account']->value)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['social_google_plus_account']->value;?>
" class="social-profile googleplus-profile"><i class="fa fa-google-plus fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_social_google_plus']->value;?>
</a><?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['social_youtube_account']->value)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['social_youtube_account']->value;?>
" class="social-profile youtube-profile"><i class="fa fa-youtube fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_social_youtube']->value;?>
</a><?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['social_vimeo_account']->value)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['social_vimeo_account']->value;?>
" class="social-profile vimeo-profile"><i class="fa fa-vimeo fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_social_vimeo']->value;?>
</a><?php }?>
<a href="./rss.xml" class="social-profile rss-profile"><i class="fa fa-rss fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['lang_rss']->value;?>
</a>
</div>
</div>
<?php }?><?php }} ?>
