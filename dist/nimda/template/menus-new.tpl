	<div id="main">
    	<div class="header">
    	    <h2><?php $this->show('h2') ?></h2>
    	</div>
		<section>		
			<div class="content">
				<div style="background:#fff; border-radius:8px;padding:2em;margin-bottom:5%;">
					<form  class="pinnackl-form pinnackl-form-stacked" method="POST"
						action="<?php $this->show('siteurl')?>nimda/options.php">
						<fieldset>
							<label><span>Menu Name :</span>
								<input class="pinnackl-input-1-2" type="text" name="menu_name" min="5" placeholder="Menu Name"
									value="">
							</label>
							<label><span>Menu Status :</span>
								<select class="pinnackl-input-1-2" name="menu_status">
									<option value="Primary">Primary</option>
									<option value="Secondary">Secondary</option>
								</select>
							</label>
							<div style="text-align:right;">
								<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</section>
	</div>
	</body>
</html>
