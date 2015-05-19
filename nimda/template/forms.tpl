<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2-list') ?></h2>
    </div>
    <div class="content">
    	 <a class="pinnackl-button pinnackl-input-1-2 pinnackl-button-primary"
            href="<?php $this->show('siteurl')?>nimda/forms/new/">Add new form</a>
    	 
    	 <table class="table">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Name</th>
		            <th>Edit</th>
		            <th>Delete</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php foreach ($this->viewData->forms as $key => $value) : ?>
		        <tr>          
		            <td><?php $this->show($value, 'form_id')      ?></td>
		            <td><?php $this->show($value, 'form_name')    ?></td>
		            <td>
		                <a class="pinnackl-button pinnackl-button-primary"
		                href="<?php $this->show('siteurl')?>nimda/forms/edit/<?php $this->show($value, 'form_name')		?>">Edit</a>
		            </td>
		            <td>
                        <a class="pinnackl-button pinnackl-button-error"
                        href="<?php $this->show('siteurl')?>nimda/forms/delete/<?php $this->show($value, 'form_id')?>">Delete</a>
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

        if(s.indexOf('delete') != -1 && s.indexOf('delete') == l-2){
            if(confirm('Are you sure ?\nYou want to delete this form')){
                window.location = Sophwork.getUrl() + "nimda/options.php";
            }
            else{
                window.location = Sophwork.getUrl() + "nimda/forms";
            }
        }
    })();
});
</script>
	