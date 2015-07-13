<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
    <div class="content">
        <div>
            <a class="pinnackl-button pinnackl-button-primary"
                href="<?php $this->show('siteurl')?>nimda/users/new/">Add New&nbsp;&#10010;</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($this->viewData->users as $key => $value) : ?>
                <tr>          
                    <td><?php $this->show($value, 'user_id'); ?></td>
                    <td><?php $this->show($value, 'user_pseudo'); ?></td>
                    <td><?php $this->show($value, 'user_email'); ?></td>
                    <td><?php $this->show($value, 'user_role'); ?></td>
                    <td>
                        <a class="pinnackl-button pinnackl-button-primary"
                           href="<?php $this->show('siteurl')?>nimda/users/edit/<?php $this->show($value, 'user_id')?>">Edit&nbsp;&#9998;</a>
                    </td>
                    <td>
                        <a class="pinnackl-button pinnackl-button-error"
                           href="<?php $this->show('siteurl')?>nimda/users/delete/<?php $this->show($value, 'user_id')?>">Delete&nbsp;&#10008;</a>
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
                    window.location = Sophwork.getUrl("nimda/options.php");
                }
                else{
                    window.location = Sophwork.getUrl("nimda/users");
                }
            }
        })();
    });
</script>