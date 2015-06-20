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
                <input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" name="_overview" value="Submit">
            </form>
        </div>
    <!-- </section> -->
</div>
