<?php
use CRM_Tournament_ExtensionUtil as E;

class CRM_Tournament_Page_Tournament extends CRM_Core_Page {
  public function run() {
    $loggedInContactID = CRM_Core_Session::singleton()->getLoggedInContactID();
    $dashboard = new CRM_Tournament_Dashboard($loggedInContactID);
    $this->assign('dashboard', $dashboard);
    parent::run();
  }
}