<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <div>
                <a class="pinnackl-button pinnackl-button-primary"
                    href="<?php $this->show('siteurl')?>nimda/pages/new/">Add New&nbsp;&#10010;</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tag</th>
                        <th>Name</th>
                        <th>Order</th>
                        <th>Connected As</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($this->viewData->pages as $key => $value) : ?>
                    <tr>          
                        <td><?php $this->show($value, 'page_id')      ?></td>
                        <td><?php $this->show($value, 'page_tag')     ?></td>
                        <td><?php $this->show($value, 'page_name')    ?></td>
                        <td><?php $this->show($value, 'page_order')   ?></td>
                        <td><?php $this->show($value, 'page_connectedAs') ?></td>
                        <td><?php $this->show($value, 'page_status')  ?></td>
                        <td><?php $this->show($value, 'page_type')    ?></td>
                        <td>
                            <a class="pinnackl-button pinnackl-button-primary"
                            href="<?php $this->show('siteurl')?>nimda/pages/edit/<?php $this->show($value, 'page_id')?>">Edit&nbsp;&#9998;</a>
                        </td>
                        <td>
                            <a class="pinnackl-button pinnackl-button-error"
                            href="<?php $this->show('siteurl')?>nimda/pages/delete/<?php $this->show($value, 'page_id')?>">Delete&nbsp;&#10008;</a>
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
            if(confirm('Are you sure ?\nYou want to delete this page')){
                window.location = Sophwork.getUrl() + "nimda/options.php";
            }
            else{
                window.location = Sophwork.getUrl() + "nimda/pages";
            }
        }
    })();
});
</script>