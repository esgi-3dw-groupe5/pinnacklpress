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
									<label><span>Category Name :</span>
										<input class="pinnackl-input-1-2" type="text" name="page_name" min="5" placeholder="Category Name"
											value="<?php $this->show('page_name') ?>">
									</label>
									<div style="text-align:right;">
										<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>	
				</div>	
			</div>
		</section>
	</div>
	</body>
</html>
