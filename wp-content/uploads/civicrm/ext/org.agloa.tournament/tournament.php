<?php

require_once 'tournament.civix.php';
// phpcs:disable
use CRM_Tournament_ExtensionUtil as E;
// phpcs:enable


/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function tournament_civicrm_navigationMenu(&$menu) {
    _tournament_civix_insert_navigation_menu($menu, '', array(
    'label' => E::ts('Tournaments'),
    'name' => 'tournament',
    // 'url' => 'civicrm/tournament',
    'permission' => 'access CiviEvent',
    'operator' => 'OR',
    'separator' => 0,
    'icon' => 'crm-i fa-calendar'
    ));

    // _tournament_civix_navigationMenu($menu);
    
    _tournament_civix_insert_navigation_menu($menu, 'tournament', array(
    'label' => E::ts('Tournament Dashboard'),
    'name' => 'dashboard',
    'url' => 'civicrm/tournament',
    'permission' => 'access CiviEvent',
    'operator' => 'OR',
    'separator' => 0
    ));

    // _tournament_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    //     'label' => E::ts('Tournament Settings'),
    //     'name' => 'Tournament Settings',
    //     'url' => 'civicrm/admin/setting/tournament',
    //     'permission' => 'administer CiviCRM',
    //     'operator' => 'OR',
    //     'separator' => 0,
    // ]);
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function tournament_civicrm_config(&$config) {
  _tournament_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function tournament_civicrm_xmlMenu(&$files) {
  _tournament_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function tournament_civicrm_install() {
  _tournament_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function tournament_civicrm_postInstall() {
  _tournament_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function tournament_civicrm_uninstall() {
  _tournament_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function tournament_civicrm_enable() {
  _tournament_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function tournament_civicrm_disable() {
  _tournament_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function tournament_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _tournament_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function tournament_civicrm_managed(&$entities) {
  _tournament_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function tournament_civicrm_caseTypes(&$caseTypes) {
  _tournament_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function tournament_civicrm_angularModules(&$angularModules) {
  _tournament_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function tournament_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _tournament_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function tournament_civicrm_entityTypes(&$entityTypes) {
  _tournament_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function tournament_civicrm_themes(&$themes) {
  _tournament_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function tournament_civicrm_preProcess($formName, &$form) {
//
//}