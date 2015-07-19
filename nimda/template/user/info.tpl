<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            <?php foreach ($this->viewData->users as $key => $value) : ?>
            <div class="global-info-user">
                <div class="avatar-user">
                    <img src="">
                </div>
                <div class="info-user">
                    <ul>
                        <li>
                            <label> Pseudo : </label> 
                            <?php $this->show($value,'user_pseudo'); ?>
                        </li>
                        
                        <li>
                            <label> Nom : </label> 
                            <?php $this->show($value,'user_name'); ?>
                        </li>
                        <li>
                            <label> Prénom : </label> 
                            <?php $this->show($value,'user_firstname'); ?>
                        </li>
                        <li>
                            <label> Email : </label> 
                            <?php $this->show($value,'user_email'); ?></li>
                        <li></li>
                    </ul>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <!-- </section> -->
</div>