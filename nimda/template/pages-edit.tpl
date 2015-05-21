	<div id="main">
	    <div class="header">
	        <h2><?php $this->show('h2') ?></h2>
	    </div>
		<section>
			<!-- Overlay -->
			<div class="overlay"></div>
			<!-- /Overlay -->
			<!-- Gridlist -->
			<div class="grid-list box">
				<header>Chose a grid <i id="close-gl"></i></header>
				<div class="layouts-list">
					<div class='layouts' data="4_4">
						<div class="dg dg-4_4"></div>
					</div>
					<div class='layouts' data="2_4,2_4">
						<div class="dg dg-2_4"></div>
						<div class="dg dg-2_4"></div>
					</div>
					<div class='layouts' data="1_3,1_3,1_3">
						<div class="dg dg-1_3"></div>
						<div class="dg dg-1_3"></div>
						<div class="dg dg-1_3"></div>
					</div>
					
					<div class='layouts' data="1_4,1_4,1_4,1_4">
						<div class="dg dg-1_4"></div>
						<div class="dg dg-1_4"></div>
						<div class="dg dg-1_4"></div>
						<div class="dg dg-1_4"></div>
					</div>
					<div class='layouts' data="2_3,1_3">
						<div class="dg dg-2_3"></div>
						<div class="dg dg-1_3"></div>
					</div>
					<div class='layouts' data="1_3,2_3">
						<div class="dg dg-1_3"></div>
						<div class="dg dg-2_3"></div>
					</div>
					<div class='layouts' data="3_4,1_4">
						<div class="dg dg-3_4"></div>
						<div class="dg dg-1_4"></div>
					</div>
					<div class='layouts' data="1_4,3_4">
						<div class="dg dg-1_4"></div>
						<div class="dg dg-3_4"></div>
					</div>
					
					<div class='layouts' data="2_4,1_4,1_4">
						<div class="dg dg-2_4"></div>
						<div class="dg dg-1_4"></div>
						<div class="dg dg-1_4"></div>
					</div>
					<div class='layouts' data="1_4,1_4,2_4">
						<div class="dg dg-1_4"></div>
						<div class="dg dg-1_4"></div>
						<div class="dg dg-2_4"></div>
					</div>
					<div class='layouts' data="1_4,2_4,1_4">
						<div class="dg dg-1_4"></div>
						<div class="dg dg-2_4"></div>
						<div class="dg dg-1_4"></div>
					</div>
				</div>
			</div>
			<!-- /Gridlist -->
			<!-- content list -->
			<div class="content-list box">
				<header>Chose a modules <i id="close-md"></i></header>
				<div class="modules-list">
					<div class='modules' data="[text]">
						<div class="md md-text"></div>
					</div>
				</div>
			</div>
			<!-- /content list -->
			<!-- Modules -->
			<div class="text-module box">
				<header>Text Module<i id="close-tx"></i></header>
				<div class="box-list">
					<div id="wysiwyg"></div>
					<div class="validate-module">
						<button id="clear-tx-md" class="pinnackl-button">Clear</button>
						<button id="save-tx-md" class="pinnackl-button">Save</button>
					</div>
				</div>
			</div>
			<!-- /Modules -->		
			<div class="content">
				<div style="background:#fff; border-radius:8px;padding:2em;margin-bottom:5%;">
					<form  class="pinnackl-form pinnackl-form-stacked" method="POST"
						action="<?php $this->show('siteurl')?>nimda/options.php">
						<fieldset>
							<label><span>Page Tag :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_tag" placeholder="Page Tag"
									value="<?php $this->show('page_tag') ?>">
							</label>
							<label><span>Page Name :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_name" placeholder="Page Name"
									value="<?php $this->show('page_name') ?>">
							</label>
							<label><span>Page Order :</span>
								<input class="pinnackl-input-1-2" type="text" name="page_order" placeholder="Page Order"
									value="<?php $this->show('page_order') ?>">
							</label>
							<label><span>Page Display :</span>
								<select class="pinnackl-input-1-2" name="page_display" >
									<option selected>Yes</option>
									<option>No</option>
								</select>
							</label>
							<label><span>Page Connected As :</span>
								<select class="pinnackl-input-1-2" name="page_connected" >
									<option <?php echo (($this->show('page_connected') == 'superadmin')? 'selected' : null) ?>>
										superadmin
									</option>
									<option <?php echo (($this->show('page_connected') == 'administrator')? 'selected' : null) ?>>
										administrator
									</option>
									<option <?php echo (($this->show('page_connected') == 'moderator')? 'selected' : null) ?>>
										moderator
									</option>
									<option <?php echo (($this->show('page_connected') == 'editor')? 'selected' : null) ?>>
										editor
									</option>
									<option <?php echo (($this->show('page_connected') == 'author')? 'selected' : null) ?>>
										author
									</option>
									<option <?php echo (($this->show('page_connected') == 'member')? 'selected' : null) ?>>
										member
									</option>
									<option <?php echo (($this->show('page_connected') == 'visitor')? 'selected' : null) ?>>
										visitor
									</option>
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
									value="<?php $this->show('page_type') ?>">
							</label>
							<div style="text-align:right;">
								<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="validate-builder">
						<input class="builder-range" id="add-number" type="range" min="1" max="12" step="1">
						<input id="number" type="text">
						<button id="add-button-obo" class="pinnackl-button pinnackl-button-primary">New line</button>
						<button id="add-button-grp" class="pinnackl-button pinnackl-button-primary">New grouped line</button>
						<button id="clear-builder" class="pinnackl-button pinnackl-button-primary">Clear</button>
						<button id="save-builder" class="pinnackl-button pinnackl-button-primary">Save</button>
				</div>
				<div id="canvas"><?php $this->viewData->layout->render(); ?></div>
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
