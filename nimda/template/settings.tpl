<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <form  class="pinnackl-form" action="options.php" method="post">
                <legend><h1><?php $this->show('legend1') ?></h1></legend>
                <fieldset class="pinnackl-group">
                    <input id="<?php $this->show('label_1') ?>"
                        name="<?php $this->show('input_1') ?>"
                        type="<?php $this->show('type_1') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_1') ?>"
                        placeholder="<?php $this->show('label_1') ?>">
                    
                    <input id="<?php $this->show('label_2') ?>"
                        name="<?php $this->show('input_2') ?>"
                        type="<?php $this->show('type_2') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_2') ?>"
                        placeholder="<?php $this->show('label_2') ?>">
                    
                    <input id="<?php $this->show('label_3') ?>"
                        name="<?php $this->show('input_3') ?>"
                        type="<?php $this->show('type_3') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_3') ?>"
                        placeholder="<?php $this->show('label_3') ?>">
                </fieldset>
                <legend><h1><?php $this->show('legend2') ?></h1></legend>
                <fieldset class="pinnackl-form-aligned">
                    <div class="pinnackl-control-group">
                        <input id="date-1" type="radio" name="permalink" value="Y-m-d"
                            <?php echo(($this->get('permalink') == 'Y-m-d')?'checked':null) ?>>
                        <label for="date-1"class="auto-width"><?php $this->show('value_3')?></label>
                        <label for="date-1"class="auto-width">
                            <?php $d=date_create();echo date_format($d,"Y-m-d"); ?> /article-name</label>
                    </div>
                    <div class="pinnackl-control-group">
                        <input id="date-2" type="radio" name="permalink" value="d-m-Y"
                            <?php echo(($this->get('permalink') == 'd-m-Y')?'checked':null) ?>>
                        <label for="date-2"class="auto-width"><?php $this->show('value_3')?></label>
                        <label for="date-2"class="auto-width">
                            <?php $d=date_create();echo date_format($d,"d-m-Y"); ?> /article-name</label>
                    </div>
                    <div class="pinnackl-control-group">
                        <input id="custom-r" type="radio" name="permalink" value="custom"
                            <?php echo(($this->get('permalink') != 'd-m-Y' && $this->get('permalink') != 'Y-m-d')?'checked':null) ?>
                            onclick="getElementById('custom').focus();">
                        <label for="custom"class="auto-width" onclick="getElementById('custom').focus();"><?php $this->show('value_3')?></label>
                        <input id="custom" type="text" name="permalink-i" placeholder="Custom"
                            value="<?php echo(($this->get('permalink') != 'd-m-Y'
                                && $this->get('permalink') != 'Y-m-d')?$this->get('permalink'):null)?>">
                        <label for="custom-r"class="auto-width">/article-name</label>
                    </div>
                </fieldset>
                <legend><h1><?php $this->show('legend3') ?></h1></legend>
                <fieldset class="pinnackl-group">
                    <input id="<?php $this->show('label_4') ?>"
                           name="<?php $this->show('input_4') ?>"
                           type="<?php $this->show('type_4') ?>"
                           class="pinnackl-input-1-2"
                           value="<?php $this->show('value_4') ?>"
                           placeholder="<?php $this->show('label_4') ?>">
                    
                    <input id="<?php $this->show('label_5') ?>"
                           name="<?php $this->show('input_5') ?>"
                           type="<?php $this->show('type_5') ?>"
                           class="pinnackl-input-1-2"
                           value="<?php $this->show('value_5') ?>"
                           placeholder="<?php $this->show('label_5') ?>">
                </fieldset>
                <fieldset class="pinnackl-form-aligned">
                    <div class="pinnackl-control-group">
                        <label>SMTP authentification :</label> 
                    </div>
                    <div class="pinnackl-control-group">
                        <label>True
                            <input type="radio" id="smtp_auth_true" name="smtp_auth" required value="true" onclick="activate();" <?php echo(($this->get('smtp_auth') == 'true')?'checked':null) ?>>
                        </label>
                        <label>False
                            <input type="radio" id="smtp_auth_false" name="smtp_auth" value="false" onclick="activate();" <?php echo(($this->get('smtp_auth') == 'false')?'checked':null) ?>>
                        </label>
                    </div>
                </fieldset>
                <fieldset class="pinnackl-group">
                    <input id="<?php $this->show('input_6') ?>"
                           name="<?php $this->show('input_6') ?>"
                           type="<?php $this->show('type_6') ?>"
                           class="pinnackl-input-1-2"
                           value="<?php $this->show('value_6') ?>"
                           placeholder="<?php $this->show('label_6') ?>"<?php echo(($this->get('smtp_auth') == 'false')?'disabled':null) ?>>
                    
                    <input id="<?php $this->show('input_7') ?>"
                           name="<?php $this->show('input_7') ?>"
                           type="<?php $this->show('type_7') ?>"
                           class="pinnackl-input-1-2"
                           value="<?php $this->show('value_7') ?>"
                           placeholder="<?php $this->show('label_7') ?>"<?php echo(($this->get('smtp_auth') == 'false')?'disabled':null) ?>>
                    
                    <input id="<?php $this->show('input_8') ?>"
                           name="<?php $this->show('input_8') ?>"
                           type="<?php $this->show('type_8') ?>"
                           class="pinnackl-input-1-2"
                           value="<?php $this->show('value_8') ?>"
                           placeholder="<?php $this->show('label_8') ?>"<?php echo(($this->get('smtp_auth') == 'false')?'disabled':null) ?>>
                </fieldset>
                <input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_overview" value="Submit">
            </form>
        </div>
    <!-- </section> -->
</div>
<script type="text/javascript" src="<?php $this->show('value_3')?>template/js/install.js"></script>