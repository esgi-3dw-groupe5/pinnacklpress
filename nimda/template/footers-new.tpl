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
						<label><span>Footer Name :</span>
							<input class="pinnackl-input-1-2" type="text" name="page_name" placeholder="Footer Name" value="">
						</label>
						<label><span>Footer Connected As :</span>
							<select class="pinnackl-input-1-2" name="page_connectedAs" >
								<option value="superadmin">
									superadmin
								</option>
								<option value="administrator">
									administrator
								</option>
								<option value="moderator">
									moderator
								</option>
								<option value="editor">
									editor
								</option>
								<option value="author">
									author
								</option>
								<option value="member">
									member
								</option>
								<option selected value="visitor">
									visitor
								</option>
							</select>
						</label>
						<label><span>Footer Status :</span>
							<select class="pinnackl-input-1-2" name="page_status" >
								<option value="publish">
									Publish
								</option>
								<option value="draft">
									Draft
								</option>
								<option value="disable">
									Disable
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
	</section>
</div>
</body>
</html>
