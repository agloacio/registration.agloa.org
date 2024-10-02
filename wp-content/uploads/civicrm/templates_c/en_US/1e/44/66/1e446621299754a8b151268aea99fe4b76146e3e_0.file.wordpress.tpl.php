<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/wordpress.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7bed58_62301500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e446621299754a8b151268aea99fe4b76146e3e' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/wordpress.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/CMSPrint.tpl' => 1,
  ),
),false)) {
function content_66f8a6be7bed58_62301500 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_smarty_tpl->_subTemplateRender("file:CRM/common/CMSPrint.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
