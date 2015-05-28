<div id="main">
    <div class="header">
        <h1><?php $this->show('h1'); ?></h1>
    </div>
    <div class="content">
    	<form  class="pinnackl-form" action="options.php" method="post">
    		<div id="field-container">
    			<?php /*var_dump($this->viewData);*/$i = 0; ?>
    			<input type="text" name="form-name" placeholder="form name" class="pinnackl-input-1-2" id="field-<?php echo $i?>" value="<?php $this->show('form_name'); ?>" required>
    			<?php foreach ($this->viewData->form as $key => $value) : ?>  
    			<?php $i++; ?>
    				<fieldset id="field-set-<?php echo $i?>" class="pinnackl-group">
    					<div id="container-button-<?php echo $i?>" class="container-button">
							<input type="text" name="field-name-<?php echo $i?>" class="pinnackl-input-1-2"  value="<?php $this->show($value, 'field_name'); ?>" required>
							<img class="test" id="<?php echo $i?>" src="/pinnacklpress/nimda/template/images/minus.png" onClick="removeField()">
						</div>
    					<select id="field-type-<?php echo $i?>" class="pinnackl-input-1-2" style="color: gray;" name="<?php echo $i?>[field-type]" required>
							<option <?php if($this->get($value, 'field_type') == "email"){echo "selected='selected'";}?>>email</option>
							<option <?php if($this->get($value, 'field_type') == "text"){echo "selected='selected'";}?>>text</option>
							<option <?php if($this->get($value, 'field_type') == "password"){echo "selected='selected'";}?>>password</option>
							<option <?php if($this->get($value, 'field_type') == "date"){echo "selected='selected'";}?>>date</option>
						</select>  
    		        	<?php //$this->show($value,'validator_rule');//foreach($this->show($value, 'validator_rule') as $k => $val) 	:   ?>
    		    
						<?php //endforeach;?>
					</fieldset>
    			<?php endforeach;?>
    		</div>
    		<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="button" name="add-field" id="add-field" value="Add field" onClick="addField()">
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_formulaire" value="Submit">
    	</form>
    </div>
</div>
<script src="<?php $this->show('siteurl') ?>/nimda/template/js/form.js"></script>