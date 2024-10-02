<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/formButtons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be813f26_10955762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c7da019427297d3d29f08f0f60647608d03dec5' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/formButtons.tpl',
      1 => 1725520235,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66f8a6be813f26_10955762 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmRegion.php','function'=>'smarty_block_crmRegion',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.crmURL.php','function'=>'smarty_function_crmURL',),3=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.smarty.php','function'=>'smarty_modifier_smarty',),4=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.substring.php','function'=>'smarty_modifier_substring',),5=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.crmReplace.php','function'=>'smarty_modifier_crmReplace',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'form-buttons'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'form-buttons'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if ($_smarty_tpl->tpl_vars['linkButtons']->value) {?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkButtons']->value, 'linkButton');
$_smarty_tpl->tpl_vars['linkButton']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['linkButton']->value) {
$_smarty_tpl->tpl_vars['linkButton']->do_else = false;
?>
    <?php if (array_key_exists('accessKey',$_smarty_tpl->tpl_vars['linkButton']->value) && $_smarty_tpl->tpl_vars['linkButton']->value['accessKey']) {?>
      <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'accessKey', null);?>accesskey="<?php echo $_smarty_tpl->tpl_vars['linkButton']->value['accessKey'];?>
"<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php } else {
$_smarty_tpl->_assignInScope('accessKey', '');?>
    <?php }?>
    <?php if (array_key_exists('icon',$_smarty_tpl->tpl_vars['linkButton']->value) && $_smarty_tpl->tpl_vars['linkButton']->value['icon']) {?>
      <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'icon', null);?><i class="crm-i <?php echo $_smarty_tpl->tpl_vars['linkButton']->value['icon'];?>
" aria-hidden="true"></i> <?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php } else {
$_smarty_tpl->_assignInScope('icon', '');?>
    <?php }?>
    <?php if (array_key_exists('ref',$_smarty_tpl->tpl_vars['linkButton']->value) && $_smarty_tpl->tpl_vars['linkButton']->value['ref']) {?>
      <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'linkname', null);?>name="<?php echo $_smarty_tpl->tpl_vars['linkButton']->value['ref'];?>
"<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php } else {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'linkname', null);
if (array_key_exists('name',$_smarty_tpl->tpl_vars['linkButton']->value)) {?>name="<?php echo $_smarty_tpl->tpl_vars['linkButton']->value['name'];?>
"<?php }
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php }?>
    <a class="button<?php if (array_key_exists('class',$_smarty_tpl->tpl_vars['linkButton']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['linkButton']->value['class'];
}?>" <?php echo $_smarty_tpl->tpl_vars['linkname']->value;?>
 href="<?php echo smarty_function_crmURL(array('p'=>$_smarty_tpl->tpl_vars['linkButton']->value['url'],'q'=>$_smarty_tpl->tpl_vars['linkButton']->value['qs']),$_smarty_tpl);?>
" <?php echo $_smarty_tpl->tpl_vars['accessKey']->value;?>
 <?php if (array_key_exists('extra',$_smarty_tpl->tpl_vars['linkButton']->value)) {
echo $_smarty_tpl->tpl_vars['linkButton']->value['extra'];?>
><?php }?><span><?php echo smarty_modifier_smarty($_smarty_tpl->tpl_vars['icon']->value,'nodefaults');
echo $_smarty_tpl->tpl_vars['linkButton']->value['title'];?>
</span></a>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
if ($_smarty_tpl->tpl_vars['form']->value) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value['buttons'], 'button', false, 'key', 'btns', array (
));
$_smarty_tpl->tpl_vars['button']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['button']->value) {
$_smarty_tpl->tpl_vars['button']->do_else = false;
?>
  <?php if (smarty_modifier_substring($_smarty_tpl->tpl_vars['key']->value,0,4) == '_qf_') {?>
    <?php if ($_smarty_tpl->tpl_vars['location']->value) {?>
      <?php echo smarty_modifier_crmReplace($_smarty_tpl->tpl_vars['form']->value['buttons'][$_smarty_tpl->tpl_vars['key']->value]['html'],'id',((string)$_smarty_tpl->tpl_vars['key']->value)."-".((string)$_smarty_tpl->tpl_vars['location']->value));?>

    <?php } else { ?>
      <?php echo $_smarty_tpl->tpl_vars['form']->value['buttons'][$_smarty_tpl->tpl_vars['key']->value]['html'];?>

    <?php }?>
  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'form-buttons'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
