<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/status.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7e6838_63009802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4bca90d33a8eec5adb5815afbbc14316d7078d99' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/status.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/info.tpl' => 1,
  ),
),false)) {
function content_66f8a6be7e6838_63009802 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.smarty.php','function'=>'smarty_modifier_smarty',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.purify.php','function'=>'smarty_modifier_purify',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if ($_smarty_tpl->tpl_vars['session']->value->getStatus(false)) {?>
  <?php $_smarty_tpl->_assignInScope('status', $_smarty_tpl->tpl_vars['session']->value->getStatus(true));?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status']->value, 'statItem', false, NULL, 'statLoop', array (
));
$_smarty_tpl->tpl_vars['statItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['statItem']->value) {
$_smarty_tpl->tpl_vars['statItem']->do_else = false;
?>
    <?php if (!empty($_smarty_tpl->tpl_vars['urlIsPublic']->value)) {?>
      <?php $_smarty_tpl->_assignInScope('infoType', "no-popup ".((string)$_smarty_tpl->tpl_vars['statItem']->value['type']));?>
    <?php } else { ?>
      <?php $_smarty_tpl->_assignInScope('infoType', $_smarty_tpl->tpl_vars['statItem']->value['type']);?>
    <?php }?>
    <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('infoTitle'=>$_smarty_tpl->tpl_vars['statItem']->value['title'],'infoMessage'=>smarty_modifier_purify(smarty_modifier_smarty($_smarty_tpl->tpl_vars['statItem']->value['text'],'nodefaults')),'infoOptions'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( smarty_modifier_smarty($_smarty_tpl->tpl_vars['statItem']->value['options'],'nodefaults') ))), 0, true);
?>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
