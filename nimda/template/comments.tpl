<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>
    <div class="content"> 	 
    	 <table class="table">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Author</th>
                    <th>Post</th>
                    <th>Date</th>
                    <th>Update</th>
                    <th>Active</th>
		            <th>Edit</th>
		            <th>Delete</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php foreach ($this->viewData->comments as $key => $value) : ?>
		        <tr>          
		            <td><?php $this->show($value, 'com_id')      ?></td>
		            <td><?php $this->show($value, 'com_author')    ?></td>
                    <td><?php $this->show($value, 'post_id')    ?></td>
                    <td><?php $this->show($value, 'com_date')    ?></td>
                    <td><?php $this->show($value, 'com_update')    ?></td>
                    <td>
                        <form action="options.php" method="post">    
                            <div class="onoffswitch">
                                <input type="checkbox" name="sidebar" class="onoffswitch-checkbox" id="<?php $this->show($value, 'com_id')?>"
                                <?php echo(($this->get($value, 'com_active')=='1')?'checked':null)?> >
                                    <label class="onoffswitch-label" for="<?php $this->show($value, 'com_id')?>">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch comment"></span>
                                    </label>
                            </div> 
                    </td>
		            <td>
                        <!--<input class="pinnackl-button pinnackl-button-primary" type="submit" value="Edit">-->
		                <a class="pinnackl-button pinnackl-button-primary" onclick="form.submit()"
		                href="option.php">Edit&nbsp;&#9998;</a>
		            </td>
                    </form>   
		            <td>
                        <a class="pinnackl-button pinnackl-button-error"
                        href="<?php $this->show('siteurl')?>nimda/comments/delete/<?php $this->show($value, 'com_id')?>">Delete&nbsp;&#10008;</a>
                    </td>
		        </tr>
		        <?php endforeach; ?>
		    </tbody>
		</table>
    </div>
</div>
<script src="/pinnacklpress/nimda/template/js/form.js"></script>
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