	<div id="main">
    	<div class="header">
    	    <h2><?php $this->show('h2') ?></h2>
    	</div>
		<section>
			<div class="content" style="max-width:100%">
				<div class="line">
					<div class="grid-2_4" style="">
						<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
							<form  class="pinnackl-form pinnackl-form-stacked" method="POST"
								action="<?php $this->show('siteurl')?>nimda/options.php">
								<fieldset>
									<label><span>Menu Name :</span>
										<input class="pinnackl-input-1-2" type="text" name="menu_name" min="5" placeholder="Menu Name"
											value="<?php $this->show('menu_name') ?>">
									</label>
									<label><span>Menu Status :</span>
										<select class="pinnackl-input-1-2" name="menu_status">
											<option
											<?php echo(($this->get($this->viewData,'menu_status')=='secondary')?'selected':null) ?> >
												Secondary
											</option>
											<option
											<?php echo(($this->get($this->viewData,'menu_status')=='primary')?'selected':null) ?> >		Primary
											</option>
										</select>
									</label>
									<div style="text-align:right;">
										<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<div class="grid-2_4">
						<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
							<form  class="pinnackl-form pinnackl-form-stacked" method="POST"
								action="<?php $this->show('siteurl')?>nimda/options.php">
								<div class="multiselect">
								<?php foreach ($this->viewData->pages as $key => $value) : ?>
									<label>
										<input type="checkbox" name="pages[]"
											value="<?php $this->show($value, 'page_id') ?>"
										<?php echo((in_array($this->get($value, 'page_id'),$this->viewData->linked))?'checked':null) ?> >
										<?php $this->show($value, 'page_name') ?>
									</label>
								<?php endforeach; ?>
								</div>
								<div style="text-align:right;">
									<input type="submit" class="pinnackl-button pinnackl-button-primary" name="menuBuilder" value="Save">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="line">
					<div class="gird-4_4">
						<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
							plop
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	</body>
</html>
<script>
	var checkboxes = document.querySelectorAll("input[type=checkbox]");
	[].forEach.call(checkboxes, function(checkbox) {
		if(checkbox.checked)
			checkbox.parentNode.classList.add('multiselect-on');
		else
			checkbox.parentNode.classList.remove('multiselect-on');
		checkbox.addEventListener('click', function(){
			if(this.checked)
				this.parentNode.classList.add('multiselect-on');
			else
				this.parentNode.classList.remove('multiselect-on');
		});
	});
	// console.log(checkbox);
</script>