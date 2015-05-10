<div id="main">
    <div class="header">
        <h1><?php $this->show('h1');//var_dump($this->viewData); ?></h1>
    </div>
    <div class="content">
    	<form  class="pinnackl-form" action="options.php" method="post">
    		<input type="text" name="form-name" placeholder="form name" class="pinnackl-input-1-2" id="field-1" value="<?php $this->show('form_name'); ?>" required>
    		<?php foreach ($this->viewData->form as $key => $value) : ?>     
    			<fieldset id="field-set-1" class="pinnackl-group">
    				<input type="text" name="field-name" placeholder="field name" class="pinnackl-input-1-2"  value="<?php $this->show($value, 'field_name'); ?>" required>  
    				<select id="field-type-1" class="pinnackl-input-1-2" style="color: gray;" name="1[field-type]" required="">
						<option <?php if($this->show($value, 'field_type') == "email"){echo "selected='selected'";}?>>email</option>
						<option <?php if($this->show($value, 'field_type') == "text"){echo "selected='selected'";}?>>text</option>
						<option <?php if($this->show($value, 'field_type') == "password"){echo "selected='selected'";}?>>password</option>
						<option <?php if($this->show($value, 'field_type') == "date"){echo "selected='selected'";}?>>date</option>
					</select>  
					<?php $this->show($value, 'field_type'); ?>
    		        <?php foreach($this->show($value, 'validator_rule') as $k => $val) 	:   ?>
    		    
					<?php endforeach;?>
				</fieldset>
    		<?php endforeach;//var_dump($this->viewData); ?>
    	</form>
    </div>
</div>