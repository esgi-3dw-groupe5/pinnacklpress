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
							<label><span>Category Name :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_name" min="5" placeholder="Category Name"
									value="<?php $this->show('page_name') ?>">
							</label>
							<label><span>Post Connected As :</span>
								<select class="pinnackl-input-1" name="page_connectedAs" >
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