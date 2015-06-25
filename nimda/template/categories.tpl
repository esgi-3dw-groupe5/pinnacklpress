<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <div>
                <a class="pinnackl-button pinnackl-button-primary"
                    href="<?php $this->show('siteurl')?>nimda/categories/new/">Add New</a>
            </div>
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
                    <?php foreach ($this->viewData->pages as $key => $value) : ?>
                    <tr>          
                        <td><?php $this->show($value, 'page_id')      ?></td>
                        <td><?php $this->show($value, 'page_name')    ?></td>
                        <td>
                            <a class="pinnackl-button pinnackl-button-primary"
                            href="<?php $this->show('siteurl')?>nimda/categories/edit/<?php $this->show($value, 'page_id')?>">Edit&nbsp;&#9998;</a>
                        </td>
                        <td>
                            <a class="pinnackl-button pinnackl-button-error"
                            href="<?php $this->show('siteurl')?>nimda/categories/delete/<?php $this->show($value, 'page_id')?>">Delete&nbsp;&#10008;</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!-- </section> -->
</div>
<script>
Sophwork.ready(function(){
    (function(){
        var e = window.location.href;
        var s = e.split('/');
        var l = s.length;

        if(s.indexOf('delete') != -1 && s.indexOf('delete') == l-2){
            if(confirm('Are you sure ?\nYou want to delete this category')){
                window.location = Sophwork.getUrl() + "nimda/options.php";
            }
            else{
                window.location = Sophwork.getUrl() + "nimda/categories";
            }
        }
    })();
});
</script>