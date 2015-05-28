aImage = document.getElementsByTagName('img');

for( var x=0; x < aImage.length; x++ ) {
	aImage[x].onclick = removeField;
};

var numberLine = document.getElementsByTagName('fieldset').length;

	function removeField(){
		id = this.id;
		idFieldset = "field-set-" + id;
		fieldset = document.getElementById(idFieldset);
		fieldset.remove(fieldset);
	}

	function addField(){
		numberLine ++;

		//Create fieldset
		var fieldset          = document.createElement('fieldset');
		var idFieldset        = 'field-set-' + numberLine;
		fieldset.id           = idFieldset;
		fieldset.className    = "pinnackl-group";

		// Create field name
		var nameField         = document.createElement('input');
		var idFieldName       = 'field-name-' + numberLine;;
		nameField.type        = 'text';
		nameField.className   = 'pinnackl-input-1-2';
		nameField.name        = numberLine + "[field-name]"; 
		nameField.id          = idFieldName;
		nameField.placeholder = 'field name';
		nameField.required    = true;

		//Create remove field button
		var removeBtn         = document.createElement('img');
		removeBtn.id          = numberLine;
		removeBtn.src         = "/pinnacklpress/nimda/template/images/minus.png";

		var divBtn            = document.createElement('div');
		divBtn.id             = "container-button-" + numberLine;
		divBtn.className      = "container-button";

		// Create field type
		var typeField         = document.createElement('select');
		var idFieldType       = 'field-type-' + numberLine;
		var init              = document.createElement('option');
		var email             = document.createElement('option');
		var text              = document.createElement('option');
		var password          = document.createElement('option');
		var date              = document.createElement('option');
		init.text             = "select form's type";
		init.value            = "";
		init.selected         = true;

		init.hidden           = true;
		init.disabled         = true;           typeField.add(init);
		email.text            = 'email'; 		typeField.add(email);
		text.text             = 'text'; 		typeField.add(text);
		password.text         = 'password'; 	typeField.add(password);
		date.text             = 'date';			typeField.add(date);
		typeField.id          = idFieldType;
		typeField.style       = "color:gray;";
		typeField.name        = numberLine + '[field-type]'; 
		typeField.className   = 'pinnackl-input-1-2';
		typeField.required    = true;

		// Create div for validator
		var div               = document.createElement('div');
		div.className         = "container-validator";
		div.id 	              = "container-validator-" + numberLine; 


		var container = document.getElementById("field-container");
		container.appendChild(fieldset);
		fieldset.appendChild(divBtn);
		var idBtn = "container-button-" + numberLine;
		var containerBtn = document.getElementById(idBtn);
		containerBtn.appendChild(nameField);
		containerBtn.appendChild(removeBtn);
		fieldset.appendChild(typeField);
		fieldset.appendChild(div);
		validator('email');
		validator('date');
		validator('password'); 	

		document.getElementById(numberLine).onclick = removeField;
	}

	function validator(rule){
		var validatorField    = document.createElement('input');
		var idFieldValidator  = 'field-validator-' + rule + '-' + numberLine;
		validatorField.type   = 'checkbox';
		validatorField.id     = idFieldValidator;
		validatorField.name   = numberLine + '[' + rule + ']';

		var label       = document.createElement('label');
		label.id        = idFieldValidator;
		label.htmlFor   = idFieldValidator;
		label.innerHTML = "is " + rule;

		var container = "container-validator-" + numberLine;
		var div       = document.getElementById(container);
		//div.appendChild(validatorField);
		div.appendChild(label);
		label.appendChild(validatorField);
	}