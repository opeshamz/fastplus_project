<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/header.html" */ ?>
<?php /*%%SmartyHeaderCode:1977864611602d1b9f6cc5f2-72166703%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5cacd03359a15f3dad0d27519bfeeb2d37c1da4' => 
    array (
      0 => 'themes/default/header.html',
      1 => 1458314318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1977864611602d1b9f6cc5f2-72166703',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'general_siteurl' => 0,
    'seo_title' => 0,
    'seo_description' => 0,
    'seo_keywords' => 0,
    'is_category' => 0,
    'page_number' => 0,
    'category_category' => 0,
    'category_id' => 0,
    'is_news' => 0,
    'article_title' => 0,
    'article_thumbnail_link' => 0,
    'apis_twitter_account_username' => 0,
    'article_sitelink' => 0,
    'general_seo_title' => 0,
    'article_datetime' => 0,
    'article_category_id' => 0,
    'article_tags' => 0,
    'apis_facebook_admin_id' => 0,
    'lang_language_direction' => 0,
    'google_font' => 0,
    'general_site_language' => 0,
    'lang_home' => 0,
    'mail_enable_contact_page' => 0,
    'lang_contact' => 0,
    'pages' => 0,
    'links' => 0,
    'lang_search' => 0,
    'is_search' => 0,
    'q' => 0,
    'theme_display_megamenu' => 0,
    'categories' => 0,
    'sub' => 0,
    'lang_all' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f74cd41_57768018',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f74cd41_57768018')) {function content_602d1b9f74cd41_57768018($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_html_decode')) include './plugins/modifier.html_decode.php';
if (!is_callable('smarty_modifier_slug')) include './plugins/modifier.slug.php';
if (!is_callable('smarty_modifier_get_meta_datetime')) include './plugins/modifier.get_meta_datetime.php';
if (!is_callable('smarty_modifier_get_category')) include './plugins/modifier.get_category.php';
if (!is_callable('smarty_modifier_get_ad')) include './plugins/modifier.get_ad.php';
if (!is_callable('smarty_modifier_get_sub_categories')) include './plugins/modifier.get_sub_categories.php';
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<BASE href="<?php echo $_smarty_tpl->tpl_vars['general_siteurl']->value;?>
">	
	<link rel="shortcut icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['general_siteurl']->value;?>
/themes/default/images/favicon.png"/>
    <title><?php echo $_smarty_tpl->tpl_vars['seo_title']->value;?>
</title>
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['seo_description']->value;?>
">
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['seo_keywords']->value;?>
">
	<?php if ($_smarty_tpl->tpl_vars['is_category']->value==1&&$_smarty_tpl->tpl_vars['page_number']->value>0) {?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['general_siteurl']->value;?>
/category/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['category_category']->value));?>
?cid=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
" rel="canonical" />
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['is_news']->value==1) {?>
	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['article_title']->value);?>
">
	<meta itemprop="description" content="<?php echo $_smarty_tpl->tpl_vars['seo_description']->value;?>
">
	<meta itemprop="image" content="<?php echo $_smarty_tpl->tpl_vars['article_thumbnail_link']->value;?>
">
	
	<link rel="image_src" href="<?php echo $_smarty_tpl->tpl_vars['article_thumbnail_link']->value;?>
" />  
	<!-- Twitter Card data -->
	<meta name="twitter:card" content="<?php echo $_smarty_tpl->tpl_vars['article_thumbnail_link']->value;?>
">
	<meta name="twitter:site" content="<?php echo $_smarty_tpl->tpl_vars['general_siteurl']->value;?>
">
	<meta name="twitter:title" content="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['article_title']->value);?>
">
	<meta name="twitter:description" content="<?php echo $_smarty_tpl->tpl_vars['seo_description']->value;?>
">
	<meta name="twitter:creator" content="<?php echo $_smarty_tpl->tpl_vars['apis_twitter_account_username']->value;?>
">
	<!-- Twitter summary card with large image must be at least 280x150px -->
	<meta name="twitter:image:src" content="<?php echo $_smarty_tpl->tpl_vars['article_thumbnail_link']->value;?>
">

	<!-- Open Graph data -->
	<meta property="og:title" content="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['article_title']->value);?>
" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['article_sitelink']->value;?>
" />
	<meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['article_thumbnail_link']->value;?>
" />
	<meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['seo_description']->value;?>
" />
	<meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['general_seo_title']->value;?>
" />
	<meta property="article:published_time" content="<?php echo smarty_modifier_get_meta_datetime($_smarty_tpl->tpl_vars['article_datetime']->value);?>
" />
	<meta property="article:modified_time" content="<?php echo smarty_modifier_get_meta_datetime($_smarty_tpl->tpl_vars['article_datetime']->value);?>
" />
	<meta property="article:section" content="<?php echo smarty_modifier_get_category($_smarty_tpl->tpl_vars['article_category_id']->value);?>
" />
	<meta property="article:tag" content="<?php echo $_smarty_tpl->tpl_vars['article_tags']->value;?>
" />
	<meta property="fb:admins" content="<?php echo $_smarty_tpl->tpl_vars['apis_facebook_admin_id']->value;?>
" /> 
	<?php }?>
    <link rel="stylesheet" href="themes/default/css/<?php echo strtolower($_smarty_tpl->tpl_vars['lang_language_direction']->value);?>
/bootstrap.min.css">
	<link rel="stylesheet" href="themes/default/css/<?php echo strtolower($_smarty_tpl->tpl_vars['lang_language_direction']->value);?>
/bootstrap-theme.min.css">
	<?php echo $_smarty_tpl->tpl_vars['google_font']->value;?>

	<link rel="stylesheet" href="themes/default/css/font-awesome.min.css">
    <link rel="stylesheet" href="themes/default/css/<?php echo strtolower($_smarty_tpl->tpl_vars['lang_language_direction']->value);?>
/style.css">
	<?php echo '<script'; ?>
 src="languages/<?php echo $_smarty_tpl->tpl_vars['general_site_language']->value;?>
/site.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="themes/default/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="themes/default/js/<?php echo strtolower($_smarty_tpl->tpl_vars['lang_language_direction']->value);?>
/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="themes/default/js/jquery.lazyloadxt.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="themes/default/js/jquery.sticky-kit.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="themes/default/js/rrssb.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="themes/default/js/functions.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class="container full-container">
<div class="top-menu">
<div class="row">
<ul class="col-md-8">
<li><a href="./"><?php echo $_smarty_tpl->tpl_vars['lang_home']->value;?>
</a></li>
<?php if ($_smarty_tpl->tpl_vars['mail_enable_contact_page']->value==1) {?>
<li><a href="./contact"><?php echo $_smarty_tpl->tpl_vars['lang_contact']->value;?>
</a></li>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['pages']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['place']==0) {?>
<li><a href="./page/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']));?>
?pid=<?php echo $_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" title="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['pages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
</a></li>
<?php }?>
<?php endfor; endif; ?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['links']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['place']==0) {?>
<li>
<a href="<?php echo $_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['link'];?>
" target="<?php echo $_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['target'];?>
" <?php if ($_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['nofollow']==1) {?>rel="nofollow"<?php }?> title="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['links']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['title']);?>
</a>
</li>
<?php }?>
<?php endfor; endif; ?>
</ul>
<ul class="col-md-4 hidden-sm hidden-xs search-nav">
<li class="search-form">
	<form method="GET" action="./search">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['lang_search']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['is_search']->value)&&$_smarty_tpl->tpl_vars['is_search']->value==1) {?>value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
"<?php }?> />
			<span class="input-group-addon"><button type="submit" class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
</li>
</ul>
</div>
</div>
<div class="header">
	
		<div class="row">
			<div class="col-md-3">
				<div class="logo">
					<a href="./" title="<?php echo $_smarty_tpl->tpl_vars['general_seo_title']->value;?>
">
						<img src="themes/default/images/logo.png" class="img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['general_seo_title']->value;?>
" />
					</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="header-ad">
					<?php echo smarty_modifier_get_ad('header');?>

				</div>
			</div>
		</div>
	</div>
<?php if ($_smarty_tpl->tpl_vars['theme_display_megamenu']->value==1) {?>
<nav class="navbar yamm navbar-inverse hidden-xs">
      
	  <div class="row">
        <div id="navbar-collapse" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" id="megamenu">
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['categories']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
			<li class="dropdown yamm-fw">
			<a href="javascript:void();" id="<?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" data-toggle="dropdown" class="dropdown-toggle"><?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category'];?>
 <b class="caret"></b></a>
			<div class="dropdown-menu ajax-menu"></div>
			</li>
			<?php endfor; endif; ?>
          </ul>
        </div>
		</div>
</nav>
<?php }?>
<nav class="navbar navbar-inverse <?php if ($_smarty_tpl->tpl_vars['theme_display_megamenu']->value==1) {?>visible-xs<?php }?>" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#second-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<span class="navbar-brand visible-xs">Categories</span>
            </div>

            <div class="collapse navbar-collapse" id="second-menu">
                <ul class="nav navbar-nav paragraph-font">
                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['categories']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
					<?php if (smarty_modifier_get_sub_categories($_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'])==0) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['is_category']->value==1&&$_smarty_tpl->tpl_vars['category_id']->value==$_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id']) {?>class="active"<?php }?>><a href="./category/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category']));?>
?cid=<?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category'];?>
</a></li>
					<?php } else { ?>
					<li class="dropdown">
					<a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category']);?>
 <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = smarty_modifier_get_sub_categories($_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['sub']->key;
?>
							<li><a href="./category/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['sub']->value['category']));?>
?cid=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id'];?>
" title="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['sub']->value['category']);?>
"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['sub']->value['category']);?>
</a></li>
						<?php } ?>
							<li class="divider"></li>
							<li><a href="./category/<?php echo smarty_modifier_slug(smarty_modifier_html_decode($_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category']));?>
?cid=<?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category'];?>
"><?php echo $_smarty_tpl->tpl_vars['lang_all']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['category'];?>
</a></li>
					</ul>
					</li>
					<?php }?>
					<?php endfor; endif; ?>
                </ul>
            </div><!--.nav-collapse -->
		
    </nav>
	<div class="search-form hidden-md hidden-lg">
	<form method="GET" action="./search">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['lang_search']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['is_search']->value)&&$_smarty_tpl->tpl_vars['is_search']->value==1) {?>value="<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
"<?php }?> />
			<span class="input-group-addon"><button type="submit" class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div><?php }} ?>
