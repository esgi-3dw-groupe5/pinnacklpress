<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <div class="global-info-user">
                <div class="avatar-user">
                    <img src="<?php $this->show('siteurl')?>data/users/<?php $this->show('user_pseudo')?>/<?php $this->show('user_pseudo')?>.png">
                </div>
                <div class="info-user">
                    <ul>
                        <li>
                            <label> Pseudo : </label> 
                            <?php $this->show('user_pseudo'); ?>
                        </li>
                        
                        <li>
                            <label> Last Name : </label> 
                            <?php $this->show('user_name'); ?>
                        </li>
                        <li>
                            <label>First name: </label> 
                            <?php $this->show('user_firstname'); ?>
                        </li>
                        <li>
                            <label> Email : </label> 
                            <?php $this->show('user_email'); ?></li>
                        <li></li>
                    </ul>

                </div>
            </div>
        </div>
    <!-- </section> -->
</div>