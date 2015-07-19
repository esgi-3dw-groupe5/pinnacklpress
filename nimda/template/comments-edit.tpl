	<div id="main">
    	<div class="header">
    	    <h2><?php $this->show('h2') ?></h2>
    	</div>
		<!-- <section>	 -->
		<div class="content">
			<div class="line">
				<div class="grid-4_4">
					<div class="grid-4_4 page-comments">
						<div class="grid-4_4 author comment">
							<div class="grid-3_4"><?php $this->show($this->viewData, 'com_author')?></div>
						</div>
						<div class="grid-4_4 preview"><?php $this->show($this->viewData, 'com_content')?></div>
						<div class="grid-4_4 footer_comment">
							<div class="grid-3_4 date"><?php $this->show($this->viewData, 'com_date')?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- </section> -->
	<div class='line' style="background:#fff; border-radius:8px;margin-top:2em;margin-bottom:5%;padding:2em;width:15%;">
		<table class="comment-table">
		<tr>
            <th>Active</th>
            <th>Edit</th>
		</tr>
		<tr>
		 	<td>  
                <div class="onoffswitch">
                    <input type="checkbox" name="sidebar" class="onoffswitch-checkbox" id="<?php $this->show($this->viewData, 'com_id')?>"
                    <?php echo(($this->get($this->viewData, 'com_active')=='1')?'checked':null)?> >
                        <label class="onoffswitch-label" for="<?php $this->show($this->viewData, 'com_id')?>">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch comment"></span>
                        </label>
                </div> 
            </td>
            <td>
                <a class="comment-button pinnackl-button pinnackl-button-error"
                href="<?php $this->show('siteurl')?>nimda/comments/delete/<?php $this->show($this->viewData, 'com_id')?>">Delete&nbsp;&#10008;</a>
            </td>
        </tr>
        </table>
	</div>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/form.js"></script>
	<script>
	Sophwork.ready(function(){
	    (function(){
	        var e = window.location.href;
	        var s = e.split('/');
	        var l = s.length;
	
	        loadNodesBuilder();
	
	
	        if(s.indexOf('delete') != -1 && s.indexOf('delete') == l-2){
	            if(confirm('Are you sure ?\nYou want to delete this comment')){
	                window.location = Sophwork.getUrl() + "nimda/options.php";
	            }
	            else{
	                window.location = Sophwork.getUrl() + "nimda/comments";
	            }
	        }
	    })();
	});
	</script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/jquery-1.11.0.min.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/libs/sophwork.js"></script>
	<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/common.js"></script>	
	</body>
</html>
