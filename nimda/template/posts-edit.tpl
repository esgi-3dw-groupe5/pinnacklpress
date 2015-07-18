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
											<input class="pinnackl-input-1" type="text" name="page_order" placeholder="Page Order"
												value="<?php $this->show('page_order')?>">
										</label>
										<label><span>Post Connected As :</span>
											<select class="pinnackl-input-1" name="page_connectedAs" >
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='superadmin')
													?'selected' :null)?>
													value="superadmin">
													superadmin
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='administrator')
													?'selected':null)?>
													value="administrator">
													administrator
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='moderator')
													?'selected':null)?>
													value="moderator">
													moderator
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='editor')
													?'selected':null)?>
													value="editor">
													editor
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='author')
													?'selected':null)?>
													value="author">
													author
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='member')
													?'selected':null)?>
													value="member">
													member
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_connectedAs')=='visitor')
													?'selected': null)?>
													value="visitor">
													visitor
												</option>
											</select>
										</label>
										<label><span>Post Status :</span>
											<select class="pinnackl-input-1" name="page_status" >
												<option <?php echo(($this->get($this->viewData, 'page_status')=='publish')
													?'selected': null)?> 
													value="publish">
													Publish
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_status')=='draft')
													?'selected': null)?> 
													value="draft">
													Draft
												</option>
												<option <?php echo(($this->get($this->viewData, 'page_status')=='disable')
													?'selected': null)?> 
													value="disable">
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
											<?php echo((in_array($this->get($value, 'page_id'),$this->viewData->linked))?'checked':null) ?> >
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
										<label><span>Post Slug :</span>
											<input class="pinnackl-input-1" type="text" name="page_tag" placeholder="Post Slug"
												value="<?php $this->show('page_tag')?>">
										</label>
										<label><span>Post Name :</span>
											<input class="pinnackl-input-1" type="text" name="page_name" placeholder="Post Name"
												value="<?php $this->show('page_name')?>">
										</label>
											<div id="wysiwyg" data="<?php addslashes($this->show('page_content'))?>"></div>
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
