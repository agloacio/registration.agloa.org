<?php
class CRM_Tournament_Dashboard {
  public $contact;
  public $contactHref;
  public $billingOrganizations;
  public $registrationGroups;

  public function __construct($contactId) {
    $contacts = \Civi\Api4\Contact::get(TRUE)
    ->addSelect('display_name', 'first_name', 'nick_name', 'groups', 'tags')
    ->addWhere('id', '=', $contactId)
    ->execute();

    $this->contact = $contacts[0];
    $this->contactHref = "$contactHref";
    $this->billingOrganizations = $billingOrganizations;
    $this->registrationGroups = $registrationGroups;
  }

  public function message() {
    return "Dashboard: " . $this->user;
  }
}