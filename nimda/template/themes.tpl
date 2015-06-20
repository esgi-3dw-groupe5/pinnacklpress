<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <form  class="pinnackl-form" action="options.php" method="post">
                <legend><h1><?php $this->show('legend1') ?></h1></legend>
                <fieldset class="">
                    <input id="<?php $this->show('label_1') ?>"
                        name="<?php $this->show('input_1') ?>"
                        type="<?php $this->show('type_1') ?>"
                        class="pinnackl-input-1-2"
                        value="<?php $this->show('value_1') ?>"
                        placeholder="<?php $this->show('value_1') ?>">

                </fieldset>
                <legend><h1><?php $this->show('legend2') ?></h1></legend>
                <fieldset class="pinnackl-group property">
                	<label>Activate Sidebar</label>
				    <div class="onoffswitch">
				        <input type="checkbox" name="sidebar" class="onoffswitch-checkbox" id="myonoffswitch"
				        	<?php echo(($this->get('sidebar')=='on')?'checked':null)?> >
				        <label class="onoffswitch-label" for="myonoffswitch">
				            <span class="onoffswitch-inner"></span>
				            <span class="onoffswitch-switch"></span>
				        </label>
				    </div>
                </fieldset>
                <input class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary" type="submit" value="Submit">
            </form>
        </div>
    <!-- </section> -->
</div>
