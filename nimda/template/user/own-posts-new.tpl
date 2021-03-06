	<div id="main">
    	<div class="header">
    	    <h2><?php $this->show('h2') ?></h2>
    	</div>
		<!-- <section>	 -->
			<div class="content" style="max-width:90%">
					<form  class="pinnackl-form pinnackl-form-stacked" method="POST"
						action="<?php $this->show('siteurl')?>nimda/options.php">
						<div class="line">
							<div class="grid-1_4">
								<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
									<fieldset>
										<label><span>Post Order :</span>
											<input class="pinnackl-input-1" type="text" name="page_order" placeholder="Page Order" value="0">
										</label>
										<label><span>Post Connected As :</span>
											<select class="pinnackl-input-1" name="page_connectedAs" >
												<option value="superadmin">
													Superadmin
												</option>
												<option value="administrator">
													administrator
												</option>
												<option value="moderator">
													Moderator
												</option>
												<option value="editor">
													Editor
												</option>
												<option value="author">
													Author
												</option>
												<option value="member">
													Member
												</option>
												<optionvalue="visitor">
													Visitor
												</option>
											</select>
										</label>
										<label><span>Post Status :</span>
											<select class="pinnackl-input-1" name="page_status" >
												<optionvalue="publish">
													Publish
												</option>
												<option value="draft">
													Draft
												</option>
												<optionvalue="disable">
													Disable
												</option>
											</select>
										</label>
										<label><span>Post Comment Status :</span>
											<select class="pinnackl-input-1" name="page_comment_status" >
												<option selected value="enable">
													Enable
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
								</div>
								<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
									<label><span>Post Categories :</span>
									<div class="multiselect">
									<?php foreach ($this->viewData->category as $key => $value) : ?>
										<label>
											<input type="checkbox" name="categories[]"
												value="<?php $this->show($value, 'page_id') ?>"
											<?php $this->get($value, 'page_id') ?> >
											<?php $this->show($value, 'page_name') ?>
										</label>
									<?php endforeach; ?>
									</div>
									</label>
									<div style="text-align:right;">
										<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
									</div>
								</div>
							</div>
							<div class="grid-3_4">
								<div style="background:#fff; border-radius:8px;margin:2em;margin-bottom:5%;padding:2em;">
									<fieldset>
										<label><span>Post Name :</span>
											<input class="pinnackl-input-1" type="text" name="page_name" placeholder="Page Name">
										</label>
											<div id="wysiwyg"></div>
										<label>
											<div style="text-align:right;">
												<button id="save-builder-txt" class="pinnackl-button pinnackl-button-primary">Save</button>
											</div>
										</label>
									</fieldset>
								</div>
							</div>
						</div>
					</form>
			</div>
		<!-- </section> -->
	</div>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/jquery-1.11.0.min.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/trumbowyg.min.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/colors/trumbowyg.colors.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/base64/trumbowyg.base64.js"></script>
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function() {
			$('#wysiwyg').trumbowyg({
                btnsDef: {
                    // Customizables dropdowns
                    image: {
                        dropdown: ['insertImage', 'upload', 'base64'],
                        ico: 'insertImage'
                    }
                },
                btns: ['viewHTML',
                    '|', 'formatting',
                    '|', 'btnGrp-design',
                    '|', 'link',
                    '|', 'image',
                    '|', 'btnGrp-justify',
                    '|', 'btnGrp-lists',
                    '|', 'foreColor', 'backColor',
                    '|', 'horizontalRule']
            });
			$('#wysiwyg').trumbowyg('html', $('#wysiwyg').attr('data'));
		});
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
	</script>
	</body>
</html>
