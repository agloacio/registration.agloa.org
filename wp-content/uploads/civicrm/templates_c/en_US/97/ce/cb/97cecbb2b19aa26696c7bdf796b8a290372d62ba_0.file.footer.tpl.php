<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be8243a4_72133975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97cecbb2b19aa26696c7bdf796b8a290372d62ba' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/footer.tpl',
      1 => 1723084589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/accesskeys.tpl' => 1,
    'file:CRM/common/contactFooter.tpl' => 1,
    'file:CRM/common/notifications.tpl' => 1,
  ),
),false)) {
function content_66f8a6be8243a4_72133975 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmPermission.php','function'=>'smarty_block_crmPermission',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.crmURL.php','function'=>'smarty_function_crmURL',),3=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.ts.php','function'=>'smarty_block_ts',),4=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.crmVersion.php','function'=>'smarty_function_crmVersion',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmPermission', array('has'=>'access CiviCRM'));
$_block_repeat=true;
echo smarty_block_crmPermission(array('has'=>'access CiviCRM'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
  <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/accesskeys.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php if ($_smarty_tpl->tpl_vars['contactId']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/contactFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php }?>

  <div class="crm-footer" id="civicrm-footer">
    <?php if ($_smarty_tpl->tpl_vars['footer_status_severity']->value) {?>
    <span class="status<?php if ($_smarty_tpl->tpl_vars['footer_status_severity']->value > 3) {?> crm-error<?php } elseif ($_smarty_tpl->tpl_vars['footer_status_severity']->value > 2) {?> crm-warning<?php } else { ?> crm-ok<?php }?>">
      <a href="<?php echo smarty_function_crmURL(array('p'=>'civicrm/a/#/status'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['footer_status_message']->value;?>
</a>
    </span>&nbsp;
    <?php } else { ?>
      <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmPermission', array('has'=>'administer CiviCRM'));
$_block_repeat=true;
echo smarty_block_crmPermission(array('has'=>'administer CiviCRM'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <span class="status crm-status-none">
      <a href="<?php echo smarty_function_crmURL(array('p'=>'civicrm/a/#/status'),$_smarty_tpl);?>
"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array());
$_block_repeat=true;
echo smarty_block_ts(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>System Status<?php $_block_repeat=false;
echo smarty_block_ts(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
    </span>&nbsp;
      <?php $_block_repeat=false;
echo smarty_block_crmPermission(array('has'=>'administer CiviCRM'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <?php }?>
    <?php echo smarty_function_crmVersion(array('assign'=>'version'),$_smarty_tpl);?>

    <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array(1=>'href="http://www.gnu.org/licenses/agpl-3.0.html" rel="external" target="_blank"',2=>'href="https://civicrm.org/" rel="external" target="_blank"',3=>$_smarty_tpl->tpl_vars['version']->value));
$_block_repeat=true;
echo smarty_block_ts(array(1=>'href="http://www.gnu.org/licenses/agpl-3.0.html" rel="external" target="_blank"',2=>'href="https://civicrm.org/" rel="external" target="_blank"',3=>$_smarty_tpl->tpl_vars['version']->value), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Powered by <a %2>CiviCRM</a> %3, free and open source <a %1>AGPLv3</a> software.<?php $_block_repeat=false;
echo smarty_block_ts(array(1=>'href="http://www.gnu.org/licenses/agpl-3.0.html" rel="external" target="_blank"',2=>'href="https://civicrm.org/" rel="external" target="_blank"',3=>$_smarty_tpl->tpl_vars['version']->value), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?><br/>
  </div>
  <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/notifications.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_block_repeat=false;
echo smarty_block_crmPermission(array('has'=>'access CiviCRM'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
