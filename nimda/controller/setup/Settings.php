<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use nimda\controller\access\Controller;

class Settings extends Controller{
	public $config;
	protected $forms;
	protected $fields;

	public function __construct($config = null){
		parent::__construct();
		$this->config = $config;
		$this->forms = [];
		$this->fields = [];
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function __getForms($param){
		return $this->forms[$param];
	}

	public function __setForms($param, $value){
		$this->forms[$param] = $value;
	}

	public function __getFields($param){
		return $this->fields[$param];
	}

	public function __setFields($param, $value){
		$this->fields[$param] = $value;
	}

	public function renderView($page = null, $path = null){
		$KDM = new SophworkDM($this->config);
		$fields = $KDM->create('pp_option');

		$nameField = $KDM->create('pp_field');
			$nameField->setFieldName('nimda-site-sitename');
			$nameField->setFieldType('text');
			$nameField->setFieldDomname('sitename');
			$nameField->setFieldDomid('sitename');
				$fields->findOptionName('sitename');
			$nameField->setFieldValue($fields->getOptionValue()[0]);
			$nameField->setFieldPlaceholder('Site name');

		$descriptionField = $KDM->create('pp_field');
			$descriptionField->setFieldName('nimda-site-sitedescription');
			$descriptionField->setFieldType('text');
			$descriptionField->setFieldDomname('sitedescription');
			$descriptionField->setFieldDomid('sitedescription');
				$fields->findOptionName('sitedescription');
			$descriptionField->setFieldValue($fields->getOptionValue()[0]);
			$descriptionField->setFieldPlaceholder('Description');

		$addressField = $KDM->create('pp_field');
			$addressField->setFieldName('nimda-site-siteurl');
			$addressField->setFieldType('url');
			$addressField->setFieldDomname('siteurl');
			$addressField->setFieldDomid('siteurl');
			$addressField->setFieldValue(Sophwork::getUrl()); // Get the URL what ever is set in the database
			$addressField->setFieldPlaceholder('Site address');

		$fields->findOptionName('permalink');
		$permalink = $fields->getOptionValue()[0];
        
        $emailField = $KDM->create('pp_field');
            $emailField->setFieldName('nimda-smtp-email');
            $emailField->setFieldType('email');
            $emailField->setFieldDomname('smtp_email');
            $emailField->setFieldDomid('smtp_email');
                $fields->findOptionName('smtp_email');
            $emailField->setFieldValue($fields->getOptionValue()[0]);
            $emailField->setFieldPlaceholder('SMTP email');
        
        $hostField = $KDM->create('pp_field');
            $hostField->setFieldName('nimda-smtp-host');
            $hostField->setFieldType('text');
            $hostField->setFieldDomname('smtp_host');
            $hostField->setFieldDomid('smtp_host');
                $fields->findOptionName('smtp_host');
            $hostField->setFieldValue($fields->getOptionValue()[0]);
            $hostField->setFieldPlaceholder('SMTP host');
        
        $fields->findOptionName('smtp_auth');
        $auth = $fields->getOptionValue()[0];
        
        if($auth=='true'){
        $usernameField = $KDM->create('pp_field');
            $usernameField->setFieldName('nimda-smtp-username');
            $usernameField->setFieldType('text');
            $usernameField->setFieldDomname('smtp_username');
            $usernameField->setFieldDomid('smtp_username');
                $fields->findOptionName('smtp_username');
            $usernameField->setFieldValue($fields->getOptionValue()[0]);
            $usernameField->setFieldPlaceholder('SMTP username');
        
        $passwordField = $KDM->create('pp_field');
            $passwordField->setFieldName('nimda-smtp-password');
            $passwordField->setFieldType('text');
            $passwordField->setFieldDomname('smtp_password');
            $passwordField->setFieldDomid('smtp_password');
                $fields->findOptionName('smtp_password');
            $passwordField->setFieldValue($fields->getOptionValue()[0]);
            $passwordField->setFieldPlaceholder('SMTP password');
        
        $portField = $KDM->create('pp_field');
            $portField->setFieldName('nimda-smtp-port');
            $portField->setFieldType('number');
            $portField->setFieldDomname('smtp_port');
            $portField->setFieldDomid('smtp_port');
                $fields->findOptionName('smtp_port');
            $portField->setFieldValue($fields->getOptionValue()[0]);
            $portField->setFieldPlaceholder('SMTP port');
        }
        else{
            $usernameField = $KDM->create('pp_field');
                $usernameField->setFieldName('nimda-smtp-username');
                $usernameField->setFieldType('text');
                $usernameField->setFieldDomname('smtp_username');
                $usernameField->setFieldDomid('smtp_username');
                $usernameField->setFieldValue('');
                $usernameField->setFieldPlaceholder('SMTP username');

            $passwordField = $KDM->create('pp_field');
                $passwordField->setFieldName('nimda-smtp-password');
                $passwordField->setFieldType('text');
                $passwordField->setFieldDomname('smtp_password');
                $passwordField->setFieldDomid('smtp_password');
                $passwordField->setFieldValue('');
                $passwordField->setFieldPlaceholder('SMTP password');

            $portField = $KDM->create('pp_field');
                $portField->setFieldName('nimda-smtp-port');
                $portField->setFieldType('number');
                $portField->setFieldDomname('smtp_port');
                $portField->setFieldDomid('smtp_port');
                $portField->setFieldValue('');
                $portField->setFieldPlaceholder('SMTP port');
        }
        
        //Set fields
		$this->__setFields('nameField',$nameField);
		$this->__setFields('descriptionField',$descriptionField);
		$this->__setFields('addressField',$addressField);
		$this->__setFields('emailField',$emailField);
		$this->__setFields('hostField',$hostField);
		$this->__setFields('usernameField',$usernameField);
		$this->__setFields('passwordField',$passwordField);
		$this->__setFields('portField',$portField);

		// Get fields
		$nameField = $this->__getFields('nameField');
		$descriptionField = $this->__getFields('descriptionField');
		$addressField = $this->__getFields('addressField');
		$emailField = $this->__getFields('emailField');
		$hostField = $this->__getFields('hostField');
        $usernameField = $this->__getFields('usernameField');
        $passwordField = $this->__getFields('passwordField');
        $portField = $this->__getFields('portField');

		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Global configuration');
		$this->setViewData('legend1', 'Site configuration');
		$this->setViewData('legend2', 'Permalink configuration');
		$this->setViewData('legend3', 'SMTP configuration');
        
		// input-1
		$this->setViewData('label_1', $nameField->getFieldPlaceholder());
		$this->setViewData('input_1', $nameField->getFieldDomname());
		$this->setViewData('type_1', $nameField->getFieldType());
		$this->setViewData('value_1', $nameField->getFieldValue());
		// input-2
		$this->setViewData('label_2', $descriptionField->getFieldPlaceholder());
		$this->setViewData('input_2', $descriptionField->getFieldDomname());
		$this->setViewData('type_2', $descriptionField->getFieldType());
		$this->setViewData('value_2', $descriptionField->getFieldValue());
		// input-3
		$this->setViewData('label_3', $addressField->getFieldPlaceholder());
		$this->setViewData('input_3', $addressField->getFieldDomname());
		$this->setViewData('type_3', $addressField->getFieldType());
		$this->setViewData('value_3', $addressField->getFieldValue());
		
		$this->setViewData('permalink', $permalink);
        
        // input-4
        $this->setViewData('label_4', $emailField->getFieldPlaceholder());
        $this->setViewData('input_4', $emailField->getFieldDomname());
        $this->setViewData('type_4', $emailField->getFieldType());
        $this->setViewData('value_4', $emailField->getFieldValue());
        
        // input-5
        $this->setViewData('label_5', $hostField->getFieldPlaceholder());
        $this->setViewData('input_5', $hostField->getFieldDomname());
        $this->setViewData('type_5', $hostField->getFieldType());
        $this->setViewData('value_5', $hostField->getFieldValue());
        
        $this->setViewData('smtp_auth', $auth);
        
        // input-6
        $this->setViewData('label_6', $usernameField->getFieldPlaceholder());
        $this->setViewData('input_6', $usernameField->getFieldDomname());
        $this->setViewData('type_6', $usernameField->getFieldType());
        $this->setViewData('value_6', $usernameField->getFieldValue());
        
        // input-7
        $this->setViewData('label_7', $passwordField->getFieldPlaceholder());
        $this->setViewData('input_7', $passwordField->getFieldDomname());
        $this->setViewData('type_7', $passwordField->getFieldType());
        $this->setViewData('value_7', $passwordField->getFieldValue());
        
        // input-8
        $this->setViewData('label_8', $portField->getFieldPlaceholder());
        $this->setViewData('input_8', $portField->getFieldDomname());
        $this->setViewData('type_8', $portField->getFieldType());
        $this->setViewData('value_8', $portField->getFieldValue());
        
		$this->callView($page, 'nimda/');
	}
}