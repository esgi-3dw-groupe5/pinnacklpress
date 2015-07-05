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
                        placeholder="<?php $this->show('value_1') ?>">
                    
                    <input id="<?php $this->show('label_2') ?>"
                        name="<?php $this->show('input_2') ?>"
                        type="<?php $this->show('type_2') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_2') ?>"
                        placeholder="<?php $this->show('value_2') ?>">
                    
                    <input id="<?php $this->show('label_3') ?>"
                        name="<?php $this->show('input_3') ?>"
                        type="<?php $this->show('type_3') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_3') ?>"
                        placeholder="<?php $this->show('value_3') ?>">
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
                <input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_overview" value="Submit">
            </form>
        </div>
    <!-- </section> -->
</div>
