<?php

use CRM_Tournament_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Tournament_Form_UserProfile extends CRM_Core_Form {
  /**
   * The contact id, used when editing the form
   *
   * @var int
   */
  public $_contactId;

  public $_values = [];

  public $_individual;

  /**
   * This function is called prior to building and submitting the form
   Setup tasks, e.g., grabbing args from the url and storing them in class variables
   */
  public function preProcess() {
    parent::preProcess();

    $id = $this->getContactID();

    if (!$id) {
        CRM::addError('Contact Id not found.', 'contactId_not_found');
        return;
    }

    if (!CRM_Core_Permission::check('Contact', $id, 'edit')) {
        CRM_Utils_System::permissionDenied();
        CRM_Utils_System::civiExit();
    }

    $individuals = \Civi\Api4\Individual::get(TRUE)
        ->addSelect('prefix_id', 'first_name', 'middle_name', 'last_name', 'suffix_id', 'gender_id', 'birth_date')
        ->addWhere('id', '=', $id )
        ->setLimit(1)
        ->execute();

    // Check if individual was found
    if (!$individuals) {
        CRM::addError('Individual not found.', 'individual_not_found');
        return;
    }

    $this->_individual = $individuals[0];
  }

  public function buildQuickForm() {
    parent::buildQuickForm();
    // Add elements to the form
    $this->add('text', 'my_text_field', ts('Enter Some Text'));
    $this->add('text', 'first_name', [
        'label' => 'First Name',
        'value' => $this->_individual['first_name'],
    ]);

    $this->add('text', 'middle_name', [
        'label' => 'Middle Name',
        'value' => $this->_individual['middle_name'],
    ]);
  }

  public function postProcess() {
    parent::postProcess();

    // Validate form data
    if (!$this->validate()) {
        return;
    }

    // Save form data to individual record
    $individual = new CRM_Contact_BAO_Contact();
    $individual->id = $this->getContext('individual_id');
    $individual->first_name = $this->getValue('first_name');
    // Update other fields as needed
    $individual->save();

    // Redirect to success page or display a message
    CRM::addSuccess('Profile saved successfully.');
    $this->redirect(CRM::url('civicrm/admin/contact/browse'));
  }

    /**
   * Get the contact ID being edited.
   *
   * @return int||null
   *
   * @noinspection PhpUnhandledExceptionInspection
   */
  public function getContactID(): ?int {
    if (!$this->_contactId) {
      $this->_contactId = CRM_Utils_Request::retrieve('contactId', 'Positive', $this);
      
    }
    return $this->_contactId ? (int) $this->_contactId : (int) CRM_Core_Session::singleton()->getLoggedInContactID();
  }

}