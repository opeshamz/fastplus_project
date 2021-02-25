<?php /* Smarty version Smarty-3.1.21-dev, created on 2021-02-17 14:35:27
         compiled from "themes/default/poll-widget.html" */ ?>
<?php /*%%SmartyHeaderCode:1938588020602d1b9f80d286-14133319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4bb0afc855212a023bf0323a8b1153c0722b310' => 
    array (
      0 => 'themes/default/poll-widget.html',
      1 => 1451138630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1938588020602d1b9f80d286-14133319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'polls_display_poll_widget' => 0,
    'theme_mobile_poll_widget' => 0,
    'theme_tab_poll_widget' => 0,
    'poll_image' => 0,
    'poll_question' => 0,
    'answers' => 0,
    'poll_id' => 0,
    'lang_vote' => 0,
    'lang_results' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_602d1b9f8210f1_03268913',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_602d1b9f8210f1_03268913')) {function content_602d1b9f8210f1_03268913($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_html_decode')) include './plugins/modifier.html_decode.php';
?><?php if ($_smarty_tpl->tpl_vars['polls_display_poll_widget']->value==1) {?>
<div class="widget poll <?php if ($_smarty_tpl->tpl_vars['theme_mobile_poll_widget']->value==0) {?>hidden-xs<?php }?> <?php if ($_smarty_tpl->tpl_vars['theme_tab_poll_widget']->value==0) {?>hidden-sm<?php }?>">
<?php if (!empty($_smarty_tpl->tpl_vars['poll_image']->value)) {?>
<div class="poll-image">
<img src="upload/polls/<?php echo $_smarty_tpl->tpl_vars['poll_image']->value;?>
" class="img-responsive" alt="<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['poll_question']->value);?>
" />
<span class="heading-font"><?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['poll_question']->value);?>
</span>
</div>
<?php } else { ?>
<div class="poll-question heading-font">
<?php echo smarty_modifier_html_decode($_smarty_tpl->tpl_vars['poll_question']->value);?>

</div>
<?php }?>
<div id="vote-result"></div>
<div id="poll-result"></div>
<div id="poll">
<form method="POST" action="">
<div class="poll-answers">
<ul>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['x'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['x']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['name'] = 'x';
$_smarty_tpl->tpl_vars['smarty']->value['section']['x']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['answers']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<li class="radio">
<input type="radio" name="answer" id="t<?php echo $_smarty_tpl->tpl_vars['answers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['answers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['x']['first']) {?>CHECKED<?php }?> /> 
<label for="t<?php echo $_smarty_tpl->tpl_vars['answers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['answers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['x']['index']]['answer'];?>
</label>
</li>
<?php endfor; endif; ?>
</ul>
</div>
<div class="poll-result-buttons">
<input type="hidden" name="poll_id" id="poll_id" value="<?php echo $_smarty_tpl->tpl_vars['poll_id']->value;?>
" />
<button type="submit" name="vote" id="vote" class="btn btn-sm btn-success"><?php echo $_smarty_tpl->tpl_vars['lang_vote']->value;?>
</button>
<a href="javascript:void();" onclick="javascript:PollShowResults(<?php echo $_smarty_tpl->tpl_vars['poll_id']->value;?>
);" class="poll-show-results"><?php echo $_smarty_tpl->tpl_vars['lang_results']->value;?>
</a>
</div>
</form>
</div>
</div>
<?php }?><?php }} ?>
