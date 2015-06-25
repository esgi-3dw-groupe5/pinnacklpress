<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>
    <div class="content">
    	 <form  class="pinnackl-form" action="<?php $this->show('siteurl')?>nimda/options.php" method="post">
    	 	<div id="field-container">
    	 		<input type="text" name="form-name" placeholder="form name" class="pinnackl-input-1-2" id="field-1" required>
    	 	</div>
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="button" name="add-field" id="add-field" value="Add field" onClick="addField()">
    	 	<input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_formulaire" value="Submit">
    	 </form> 	 
<script src="<?php $this->show('siteurl') ?>/nimda/template/js/form.js"></script>

	