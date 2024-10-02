<?php
/* Smarty version 4.5.3, created on 2024-09-29 01:00:48
  from '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/l10n.js.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66f8a6c0685d92_64475502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f1171070f3296d6c319b21dda9ba6b596b80f38' => 
    array (
      0 => '/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/templates/CRM/common/l10n.js.tpl',
      1 => 1725520235,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66f8a6c0685d92_64475502 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.crmScope.php','function'=>'smarty_block_crmScope',),1=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.crmDate.php','function'=>'smarty_modifier_crmDate',),2=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.crmResURL.php','function'=>'smarty_function_crmResURL',),3=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/function.crmURL.php','function'=>'smarty_function_crmURL',),4=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/block.ts.php','function'=>'smarty_block_ts',),5=>array('file'=>'/home/agloa/registration.agloa.org/wp-content/plugins/civicrm/civicrm/CRM/Core/Smarty/plugins/modifier.smarty.php','function'=>'smarty_modifier_smarty',),));
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('crmScope', array('extensionKey'=>''));
$_block_repeat=true;
echo smarty_block_crmScope(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>// http://civicrm.org/licensing
// <?php echo '<script'; ?>
> Generated <?php echo smarty_modifier_crmDate(time(),'%d %b %Y %H:%M:%S');?>

(function($) {
  // Config settings
  CRM.config.userFramework = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['config']->value->userFramework ));?>
;
    CRM.config.resourceBase = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['config']->value->userFrameworkResourceURL ));?>
;
    CRM.config.packagesBase = <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'packagesBase', null);
echo smarty_function_crmResURL(array('expr'=>'[civicrm.packages]/'),$_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['packagesBase']->value ));?>
;
  CRM.config.lcMessages = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['lcMessages']->value ));?>
;
  CRM.config.locale = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['locale']->value ));?>
;
  CRM.config.cid = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['cid']->value ));?>
;
  $.datepicker._defaults.dateFormat = CRM.config.dateInputFormat = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['dateInputFormat']->value ));?>
;
  CRM.config.timeIs24Hr = <?php if ($_smarty_tpl->tpl_vars['timeInputFormat']->value == 2) {?>true<?php } else { ?>false<?php }?>;
  CRM.config.ajaxPopupsEnabled = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['ajaxPopupsEnabled']->value ));?>
;
  CRM.config.allowAlertAutodismissal = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['allowAlertAutodismissal']->value ));?>
;
  CRM.config.resourceCacheCode = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['resourceCacheCode']->value ));?>
;
  CRM.config.quickAdd = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['quickAdd']->value ));?>
;

  // Merge entityRef settings
  CRM.config.entityRef = $.extend({}, <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['entityRef']->value ));?>
, CRM.config.entityRef || {});

  // Initialize CRM.url and CRM.formatMoney
  CRM.url({back: '<?php echo smarty_function_crmURL(array('p'=>"civicrm/crmajax-placeholder-url-path",'q'=>"civicrm-placeholder-url-query=1",'h'=>0,'fb'=>1),$_smarty_tpl);?>
', front: '<?php echo smarty_function_crmURL(array('p'=>"civicrm/crmajax-placeholder-url-path",'q'=>"civicrm-placeholder-url-query=1",'h'=>0,'fe'=>1),$_smarty_tpl);?>
'});
  CRM.formatMoney('init', false, <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['moneyFormat']->value ));?>
);

  // Localize select2
  $.fn.select2.defaults.formatNoMatches = "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>None found.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>";
  $.fn.select2.defaults.formatLoadMore = "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Loading...<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>";
  $.fn.select2.defaults.formatSearching = "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Searching...<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>";
  $.fn.select2.defaults.formatInputTooShort = function() {
    return ($(this).data('api-entity') === 'contact' || $(this).data('api-entity') === 'Contact') ? <?php echo smarty_modifier_smarty($_smarty_tpl->tpl_vars['contactSearch']->value,'nodefaults');?>
 : <?php echo smarty_modifier_smarty($_smarty_tpl->tpl_vars['otherSearch']->value,'nodefaults');?>
;
  };

  // Localize jQuery UI
  $.ui.dialog.prototype.options.closeText = "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Close<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>";

  // Localize jQuery DataTables
  // Note the first two defaults set here aren't localization related,
  // but need to be set globally for all DataTables.
  $.extend( $.fn.dataTable.defaults, {
    "searching": false,
    "jQueryUI": true,
    "language": {
      "emptyTable": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>None found.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "info":  "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js',1=>'_START_',2=>'_END_',3=>'_TOTAL_'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js',1=>'_START_',2=>'_END_',3=>'_TOTAL_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Showing %1 to %2 of %3 entries<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js',1=>'_START_',2=>'_END_',3=>'_TOTAL_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "infoEmpty": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Showing 0 to 0 of 0 entries<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "infoFiltered": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js',1=>'_MAX_'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js',1=>'_MAX_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>(filtered from %1 total entries)<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js',1=>'_MAX_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "infoPostFix": "",
      "thousands": <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['config']->value->monetaryThousandSeparator ));?>
,
      "lengthMenu": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js',1=>'_MENU_'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js',1=>'_MENU_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Show %1 entries<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js',1=>'_MENU_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "loadingRecords": " ",
      "processing": " ",
      "zeroRecords": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>None found.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
      "paginate": {
        "first": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>First<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
        "last": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Last<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
        "next": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Next<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
        "previous": "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Previous<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"
      }
    }
  });

  // Localize strings for jQuery.validate
  var messages = {
    required: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>This field is required.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    remote: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please fix this field.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    email: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid email address.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    url: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid URL.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    date: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid date.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    dateISO: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid date (YYYY-MM-DD).<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    number: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid number.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    digits: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter only digits.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    creditcard: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a valid credit card number.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    equalTo: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter the same value again.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    accept: "<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a value with a valid extension.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
    maxlength: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter no more than {0} characters.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"),
    minlength: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter at least {0} characters.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"),
    rangelength: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a value between {0} and {1} characters long.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"),
    range: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a value between {0} and {1}.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"),
    max: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a value less than or equal to {0}.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"),
    min: $.validator.format("<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('ts', array('escape'=>'js'));
$_block_repeat=true;
echo smarty_block_ts(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter a value greater than or equal to {0}.<?php $_block_repeat=false;
echo smarty_block_ts(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>")
  };
  $.extend($.validator.messages, messages);
  

  var params = {
    errorClass: 'crm-inline-error alert-danger',
    messages: {},
    ignore: '.select2-offscreen, [readonly], :hidden:not(.crm-select2), .crm-no-validate',
    ignoreTitle: true,
    errorPlacement: function(error, element) {
      if (element.prop('type') === 'radio') {
        error.appendTo(element.parents('div.content')[0]);
      }
      else {
        error.insertAfter(element);
      }
    }
  };

  // use civicrm notifications when there are errors
  params.invalidHandler = function(form, validator) {
    // If there is no container for display then red text will still show next to the invalid fields
    // but there will be no overall message. Currently the container is only available on backoffice pages.
    if ($('#crm-notification-container').length) {
      $.each(validator.errorList, function(k, error) {
        $(error.element).parents('.crm-custom-accordion.collapsed').crmAccordionToggle();
        $(error.element).parents('.crm-custom-accordion').prop('open', true);
        $(error.element).crmError(error.message);
      });
    }
  };

  CRM.validate = {
    _defaults: params,
    params: {},
    functions: []
  };

})(jQuery);

<?php $_block_repeat=false;
echo smarty_block_crmScope(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
