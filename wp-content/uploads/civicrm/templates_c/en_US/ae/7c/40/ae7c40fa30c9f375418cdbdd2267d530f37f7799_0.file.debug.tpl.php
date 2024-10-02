<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/debug.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7dc0e9_52779818',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae7c40fa30c9f375418cdbdd2267d530f37f7799' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/debug.tpl',
      1 => 1707446171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66f8a6be7dc0e9_52779818 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?><!-- .tpl file invoked: <?php echo $_smarty_tpl->tpl_vars['tplFile']->value;?>
. Call via form.tpl if we have a form in the page. -->
<?php if ($_smarty_tpl->tpl_vars['debugging']->value['smartyDebug']) {
$_smarty_debug = new Smarty_Internal_Debug;
 $_smarty_debug->display_debug($_smarty_tpl);
unset($_smarty_debug);
}?>

<?php if ($_smarty_tpl->tpl_vars['debugging']->value['sessionReset']) {
echo $_smarty_tpl->tpl_vars['session']->value->reset($_smarty_tpl->tpl_vars['debugging']->value['sessionReset']);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['debugging']->value['sessionDebug']) {
echo $_smarty_tpl->tpl_vars['session']->value->debug($_smarty_tpl->tpl_vars['debugging']->value['sessionDebug']);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['debugging']->value['directoryCleanup']) {
echo $_smarty_tpl->tpl_vars['config']->value->cleanup($_smarty_tpl->tpl_vars['debugging']->value['directoryCleanup']);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['debugging']->value['cacheCleanup']) {
echo $_smarty_tpl->tpl_vars['config']->value->clearDBCache();?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['debugging']->value['configReset']) {
echo $_smarty_tpl->tpl_vars['config']->value->reset();?>

<?php }
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
