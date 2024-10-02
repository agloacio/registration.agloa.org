<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/Form/body.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7f7487_28691607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60556596aea8da15194970480798127cfa02437b' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/Form/body.tpl',
      1 => 1691073369,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66f8a6be7f7487_28691607 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.ts.php','function'=>'smarty_block_ts',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if (!empty($_smarty_tpl->tpl_vars['form']->value['javascript'])) {?>
  <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['form']->value['hidden'])) {?>
  <div><?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>
</div>
<?php }?>

<?php if (($_smarty_tpl->tpl_vars['snippet']->value !== 'json') && !$_smarty_tpl->tpl_vars['suppressForm']->value && $_smarty_tpl->tpl_vars['form']->value['errors']) {?>
   <div class="messages crm-error">
       <i class="crm-i fa-exclamation-triangle crm-i-red" aria-hidden="true"></i>
     <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array());
$_block_repeat=true;
echo smarty_block_ts(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please correct the following errors in the form fields below:<?php $_block_repeat=false;
echo smarty_block_ts(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
     <ul id="errorList">
     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form']->value['errors'], 'error', false, 'errorName');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['errorName']->value => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
        <?php if (is_array($_smarty_tpl->tpl_vars['error']->value)) {?>
           <li><?php echo $_smarty_tpl->tpl_vars['error']->value['label'];?>
 <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
</li>
        <?php } else { ?>
           <li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
        <?php }?>
     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
     </ul>
   </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['beginHookFormElements']->value) {?>
  <table class="form-layout-compressed">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['beginHookFormElements']->value, 'hookFormElement', false, 'dontCare');
$_smarty_tpl->tpl_vars['hookFormElement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dontCare']->value => $_smarty_tpl->tpl_vars['hookFormElement']->value) {
$_smarty_tpl->tpl_vars['hookFormElement']->do_else = false;
?>
      <tr><td class="label nowrap"><?php echo $_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['hookFormElement']->value]['label'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['hookFormElement']->value]['html'];?>
</td></tr>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </table>
<?php }
$_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
