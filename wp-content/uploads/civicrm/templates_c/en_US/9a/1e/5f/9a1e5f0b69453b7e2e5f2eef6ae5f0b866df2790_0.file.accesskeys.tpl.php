<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/accesskeys.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be82c649_35038761',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a1e5f0b69453b7e2e5f2eef6ae5f0b866df2790' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/accesskeys.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66f8a6be82c649_35038761 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.ts.php','function'=>'smarty_block_ts',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.help.php','function'=>'smarty_function_help',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if (empty($_smarty_tpl->tpl_vars['urlIsPublic']->value)) {?>
  <div class="footer" id="access">
    <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'accessKeysHelpTitle', null);
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array());
$_block_repeat=true;
echo smarty_block_ts(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Access Keys<?php $_block_repeat=false;
echo smarty_block_ts(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array());
$_block_repeat=true;
echo smarty_block_ts(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Access Keys:<?php $_block_repeat=false;
echo smarty_block_ts(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <?php echo smarty_function_help(array('id'=>'accesskeys','file'=>'CRM/common/accesskeys','title'=>$_smarty_tpl->tpl_vars['accessKeysHelpTitle']->value),$_smarty_tpl);?>

  </div>
<?php }
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
