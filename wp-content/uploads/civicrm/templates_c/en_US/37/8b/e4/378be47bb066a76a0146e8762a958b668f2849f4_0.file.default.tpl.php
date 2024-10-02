<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/Form/default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7ec8e5_47372521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '378be47bb066a76a0146e8762a958b668f2849f4' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/Form/default.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/Form/body.tpl' => 1,
  ),
),false)) {
function content_66f8a6be7ec8e5_47372521 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.smarty.php','function'=>'smarty_modifier_smarty',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmRegion.php','function'=>'smarty_block_crmRegion',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if (!$_smarty_tpl->tpl_vars['suppressForm']->value) {?>
<form <?php echo smarty_modifier_smarty($_smarty_tpl->tpl_vars['form']->value['attributes'],'nodefaults');?>
>
  <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'form-top'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'form-top'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'form-top'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>

  <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'form-body'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'form-body'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php $_smarty_tpl->_subTemplateRender("file:CRM/Form/body.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tplFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
  <?php $_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'form-body'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<?php if (!$_smarty_tpl->tpl_vars['suppressForm']->value) {?>
  <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'form-bottom'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'form-bottom'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'form-bottom'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</form>
<?php }
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
