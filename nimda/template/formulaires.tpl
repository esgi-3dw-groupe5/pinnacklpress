<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2-create') ?></h2>
    </div>
    <div class="content">
    	 <form  class="pinnackl-form" action="options.php" method="post">
    	 	<div id="field-container">
    	 		<input type="text" name="form-name" placeholder="form name" class="pinnackl-input-1-2" id="field-1" required>
    	 	</div>
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="button" name="add-field" id="add-field" value="Add field" onClick="addField()">
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_formulaire" value="Submit">
    	 </form>
    	 <h2><?php $this->show('h2-list') ?></h2>
    	 <table class="table">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Name</th>
		            <th>Edit</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php foreach ($this->viewData->forms as $key => $value) : ?>
		        <tr>          
		            <td><?php $this->show($value, 'form_id')      ?></td>
		            <td><?php $this->show($value, 'form_name')    ?></td>
		            <td>
		                <a class="pinnackl-button pinnackl-button-primary"
		                href="<?php $this->show('siteurl')?>nimda/formulaires/edit/<?php $this->show($value, 'form_name')		?>">Edit</a>
		            </td>
		        </tr>
		        <?php endforeach; ?>
		    </tbody>
		</table>
    </div>
</div>
<script type="text/javascript">
	var numberLine = 0;

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
		//removeBtn.onclick     = removeField;
		removeBtn.src         = "../template/images/minus.png";

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
		div.appendChild(validatorField);
		div.appendChild(label);
	}

	
</script>