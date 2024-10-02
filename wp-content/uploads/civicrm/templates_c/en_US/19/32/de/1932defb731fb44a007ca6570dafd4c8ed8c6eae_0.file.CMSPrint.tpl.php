<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:46
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/CMSPrint.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6be7d2b35_50181120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1932defb731fb44a007ca6570dafd4c8ed8c6eae' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/CMSPrint.tpl',
      1 => 1723084589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/debug.tpl' => 1,
    'file:CRM/common/status.tpl' => 1,
    'file:CRM/Form/".((string)$_smarty_tpl->tpl_vars[\'formTpl\']->value).".tpl' => 1,
    'file:CRM/common/publicFooter.tpl' => 1,
    'file:CRM/common/footer.tpl' => 1,
  ),
),false)) {
function content_66f8a6be7d2b35_50181120 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/packages/smarty4/vendor/smarty/smarty/libs/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmRegion.php','function'=>'smarty_block_crmRegion',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if ($_smarty_tpl->tpl_vars['config']->value->debug) {
$_smarty_tpl->_subTemplateRender("file:CRM/common/debug.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

<div id="crm-container" class="crm-container<?php if ($_smarty_tpl->tpl_vars['urlIsPublic']->value) {?> crm-public<?php }?>" lang="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['config']->value->lcMessages,2,'',true);?>
" xml:lang="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['config']->value->lcMessages,2,'',true);?>
">

<?php if ($_smarty_tpl->tpl_vars['breadcrumb']->value) {?>
  <div class="breadcrumb">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumb']->value, 'crumb', false, 'key');
$_smarty_tpl->tpl_vars['crumb']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['crumb']->value) {
$_smarty_tpl->tpl_vars['crumb']->do_else = false;
?>
      <?php if ($_smarty_tpl->tpl_vars['key']->value != 0) {?>
        <i class="crm-i fa-angle-double-right" aria-hidden="true"></i>
      <?php }?>
      <?php echo $_smarty_tpl->tpl_vars['crumb']->value;?>

    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['urlIsPublic']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['pageTitle']->value) {?>
      <div class="crm-title">
        <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h2>
      </div>
    <?php }
} else { ?>
    <?php if ($_smarty_tpl->tpl_vars['pageTitle']->value) {?>
      <div class="crm-title crm-page-title-wrapper">
        <h1 class="title"><?php if ($_smarty_tpl->tpl_vars['isDeleted']->value) {?>
          <del><?php }
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
if ($_smarty_tpl->tpl_vars['isDeleted']->value) {?></del><?php }?></h1>
      </div>
    <?php }
}?>

<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'page-header'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'page-header'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'page-header'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
<div class="clear"></div>

<div id="crm-main-content-wrapper">
  <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/status.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'page-body'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'page-body'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php if ($_smarty_tpl->tpl_vars['isForm']->value && $_smarty_tpl->tpl_vars['formTpl']->value) {?>
      <?php $_smarty_tpl->_subTemplateRender("file:CRM/Form/".((string)$_smarty_tpl->tpl_vars['formTpl']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tplFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php }?>
  <?php $_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'page-body'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</div>

<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmRegion', array('name'=>'page-footer'));
$_block_repeat=true;
echo smarty_block_crmRegion(array('name'=>'page-footer'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
if ($_smarty_tpl->tpl_vars['urlIsPublic']->value) {?>
  <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/publicFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
  <?php $_smarty_tpl->_subTemplateRender("file:CRM/common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
$_block_repeat=false;
echo smarty_block_crmRegion(array('name'=>'page-footer'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

</div> <?php $_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
