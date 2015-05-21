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
							<label><span>Page Tag :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_tag" min="5" placeholder="Page Tag"
									value="">
							</label>
							<label><span>Page Name :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_name" min="5" placeholder="Page Name"
									value="">
							</label>
							<label><span>Page Order :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_order" min="5" placeholder="Page Order"
									value="">
							</label>
							<label><span>Page Display :</span>
								<select class="pinnackl-input-1-2" name="page_display" >
									<option selected>Yes</option>
									<option>No</option>
								</select>
							</label>
							<label><span>Page Connected As :</span>
								<select class="pinnackl-input-1-2" name="page_connected" >
									<option>visitor</option>
									<option>member</option>
									<option>author</option>
									<option>editor</option>
									<option>moderator</option>
									<option>administrator</option>
									<option>superadmin</option>
								</select>
							</label>
							<label><span>Page Active :</span>
								<select class="pinnackl-input-1-2" name="page_active" >
									<option selected>Yes</option>
									<option>No</option>
								</select>
							</label>
							<label><span>Page Type :</span>
								<input class="pinnackl-input-1-2" type="text"name="page_type" placeholder="Page Type"
									value="">
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
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/jquery-1.11.0.min.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/trumbowyg.min.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/builder.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/grids.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/modules.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/listeners.js"></script>
	</body>
</html>
