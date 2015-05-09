<div id="main">
    <div class="header">
        <h1>{{h1}}</h1>
        <h2>{{h2}}</h2>
    </div>
    <div class="content">
    	 <form  class="pinnackl-form" action="options.php" method="post">
    	 	<div id="field-container">
    	 		<input type="text" name="form-name" placeholder="form name" class="pinnackl-input-1-2" id="field-1" required>
    	 	</div>
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="button" name="add-field" id="add-field" value="Add field" onClick="addField()">
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_formulaire" value="Submit">
    	 </form>
    </div>
</div>
<script type="text/javascript">
	var numberLine = 0;

	function addField(){
		numberLine ++;

		//Create fieldset
		var fieldset       = document.createElement('fieldset');
		var idFieldset     = 'field-set-' + numberLine;
		fieldset.id        = idFieldset;
		fieldset.className = "pinnackl-group";

		// Create field name
		var nameField         = document.createElement('input');
		var idFieldName       = 'field-name-' + numberLine;;
		nameField.type        = 'text';
		nameField.className   = 'pinnackl-input-1-2';
		nameField.name        = numberLine + "[field-name]"; 
		nameField.id          = idFieldName;
		nameField.placeholder = 'field name';
		nameField.required    = true;

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
		init.disabled         = true;              typeField.add(init);
		email.text            = 'email'; 
		   typeField.add(email);
		text.text             = 'text'; 
		   typeField.add(text);
		password.text         = 'password'; 
		   typeField.add(password);
		date.text             = 'date';
		    typeField.add(date);
		typeField.id          = idFieldType;
		typeField.style       = "color:gray;";
		typeField.name        = numberLine + '[field-type]'; 
		typeField.className   = 'pinnackl-input-1-2';
		typeField.required    = true;

		// Create div for validator
		var div       = document.createElement('div');
		div.className = "container-validator";
		div.id 	      = "container-validator-" + numberLine; 


		var container = document.getElementById("field-container");
		container.appendChild(fieldset);
		fieldset.appendChild(nameField);
		fieldset.appendChild(typeField);
		fieldset.appendChild(div);
		validator('email');
		validator('date');
		validator('password'); 	
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
		div.appendChild(validatorField);
		div.appendChild(label);
	}
</script>