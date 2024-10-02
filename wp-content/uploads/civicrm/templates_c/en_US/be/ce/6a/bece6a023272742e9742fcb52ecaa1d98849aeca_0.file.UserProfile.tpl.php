<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/uploads/civicrm/ext/org.agloa.tournament/templates/CRM/Tournament/Form/UserProfile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7fcc25_13208347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bece6a023272742e9742fcb52ecaa1d98849aeca' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/uploads/civicrm/ext/org.agloa.tournament/templates/CRM/Tournament/Form/UserProfile.tpl',
      1 => 1727571500,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/formButtons.tpl' => 2,
  ),
),false)) {
function content_66f8a6be7fcc25_13208347 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
<div class="crm-submit-buttons">
	<?php $_smarty_tpl->_subTemplateRender("file:CRM/common/formButtons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('location'=>"top"), 0, false);
?>
</div>


<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elementNames']->value, 'elementName');
$_smarty_tpl->tpl_vars['elementName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['elementName']->value) {
$_smarty_tpl->tpl_vars['elementName']->do_else = false;
?>
<div class="crm-section">
	<div class="label"><?php echo $_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['elementName']->value]['label'];?>
</div>
	<div class="content"><?php echo $_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['elementName']->value]['html'];?>
</div>
	<div class="clear"></div>
</div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 

<div class="crm-submit-buttons">
	<?php $_smarty_tpl->_subTemplateRender("file:CRM/common/formButtons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('location'=>"bottom"), 0, true);
?>
</div><?php $_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
