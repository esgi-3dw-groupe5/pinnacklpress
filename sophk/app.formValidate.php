<?php
class FormValidator {
    private $_validationRules;

    function __construct() {
            $this->_validationRules = array();
    }

    // Registers a new validation rule
    function addRule($aValidationRule) { $this->validationRules[] = $aValidationRule; }

    // Validates $aForm, evaluating each of the $_validationRules defined
    function validate($aForm) {
            $aValidationResult = new ValidationResult();

            foreach($this->_validationRules as $aValidationRule) {
                    $aValidationRuleResult = $aValidationRule->validate($aForm);
                    $aValidationResult->addResult($aValidationRuleResult);
            }

            return $aValidationResult;
    }
}

abstract class ValidationRule {
    private $_fieldName;

    // The form's field name to be validated
    function __construct($aFieldName) {
            $this->_fieldName = $aFieldName;
    }

    function fieldName() { return $this->_fieldName; }

    // Returns an instance of ValidationResult describing the result of evaluating the ValidationRule in $aForm.
    abstract public function validate($aForm);
}

class ValidationResult {
    private $_validationRuleResults;

    function __construct() {
            $this->_validationRuleResults = array();
    }

    // Registers a validation rule result
    function addResult($aValidationRuleResult) {
            $this->_validationRuleResults[] = $aValidationRuleResult;
    }

    // Returns the list of the error messages of the validation rule results that did't passed
    function errorsFound() {
            $errors = array();

            foreach($this->validationRuleResults as $aValidationResult) {
                    if ($aValidationResult->passed()) continue;
                    $errors[] = $aValidationResult->errorMessage();
            }

            return $errors;
    }

    // Tells whether all the validation rule results passed or not
    function validationPassed() {
            foreach($this->validationRuleResults as $validationResult) {
                    if ($validationResult->passed() == false) return false;
            }

            return true;
    }
}

class ValidationRuleResult {
    private $_passed, $_error_message;

    function __construct($passed) {
            $this->_passed = $passed;
            $this->_error_message = '';
    }

    // Tells whether the form passed this validation rule or not
    public function passed() { return $this->_passed; }

    // The error message should be empty if passed to avoid confusion
    public function errorMessage() { return $this->passed() ? '' : $this->_error_message; }
    public function setErrorMessage($anErrorMessage) { $this->_error_message = $anErrorMessage; }
}

/*
 *  Validation rules
 */
class NotEmptyValidationRule extends ValidationRule {
    public function validate($aForm) {
            $fieldName = $this->fieldName();
            $fieldValue = $aForm[$fieldName];

            $passed = !empty($fieldValue);
            $result = new ValidationRuleResult($passed);

            if (!$passed) {
                    $result->setErrorMessage("$fieldName cannot be empty");
            }

            return $result;
    }
}
