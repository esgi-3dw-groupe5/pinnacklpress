<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <div>
                <a class="pinnackl-button pinnackl-button-primary"
                    href="<?php $this->show('siteurl')?>nimda/menus/new/">Add New</a>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($this->viewData->menus as $key => $value) : ?>
                        <tr>          
                            <td><?php $this->show($value, 'menu_id')      ?></td>
                            <td><?php $this->show($value, 'menu_name')    ?></td>
                            <td><?php $this->show($value, 'menu_status')   ?></td>
                            <td>
                                <a class="pinnackl-button pinnackl-button-primary"
                                href="<?php $this->show('siteurl')?>nimda/menus/edit/<?php $this->show($value, 'menu_id')?>">Edit</a>
                            </td>
                            <td>
                                <a class="pinnackl-button pinnackl-button-error"
                                href="<?php $this->show('siteurl')?>nimda/menus/delete/<?php $this->show($value, 'menu_id')?>">Delete</a>
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
        console.log(s.indexOf('delete'));
        if(s.indexOf('delete') != -1 && s.indexOf('delete') == l-2){
            if(confirm('Are you sure ?\nYou want to delete this menu')){
                window.location = Sophwork.getUrl() + "nimda/options.php";
            }
            else{
                window.location = Sophwork.getUrl() + "nimda/menus";
            }
        }
    })();
});
</script>