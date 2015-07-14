<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>
    <!-- <section> -->
   <div class="content">
        <form  class="pinnackl-form pinnackl-form-aligned" action="<?php $this->show('siteurl')?>nimda/options.php" method="post">
            <div id="field-container">
                <fieldset>
                    <div class="pinnackl-control-group">
                        <label>Gender </label>
                        <label>Men
                            <input type="radio" name="gender" value="1" <?php echo($this->get('user_gender') == '1' ? 'checked' : ''); ?>>
                        </label>
                        <label>Women
                            <input type="radio" name="gender" value="2" <?php echo($this->get('user_gender') == '2' ? 'checked' : ''); ?>>
                        </label>
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Pseudo</label>
                        <input type="text" name="pseudo" class="pinnackl-input-1-2"  value="<?php $this->show('user_pseudo'); ?>" required>
                    </div> 
                    <div class="pinnackl-control-group">
                        <label>Email</label>
                        <input type="text" name="email" class="pinnackl-input-1-2" value="<?php $this->show('user_email'); ?>" required>
                    </div>
                    
                    <div class="pinnackl-control-group">
                         <label>First name</label>
                        <input type="text" name="firstname" class="pinnackl-input-1-2" value="<?php $this->get('user_firstname') == 'null' ? ' ' : $this->show('user_firstname'); ?>" >
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Last name</label>
                        <input type="text" name="lastname" class="pinnackl-input-1-2" value="<?php $this->get('user_name') == 'null' ? ' ' : $this->show('user_name'); ?>" required>
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Birthday</label>
                        <input type="date" name="bdate" class="pinnackl-input-1-2" value="<?php $this->get('user_bdate') == 'null' ? ' ' : $this->show('user_bdate'); ?>">
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Role</label>
                        <select id="user_role" class="pinnackl-input-1-2" style="color: gray;" name="role" required>
                            <option value="surperamdin">Superadmin</option>
                            <option value="administrator">administrator</option>
                            <option value="moderator">moderator</option>
                            <option value="editor">editor</option>
                            <option value="author">author</option>
                            <option value="member">member</option>
                            <option value="visitor">visitor</option>
                        </select>  
                    </div>  
                 </fieldset>                
            </div>
            <div class="pinnackl-controls">
                <input class="pinnackl-button pinnackl-button-primary" type="submit" name="" value="Submit">
            </div>
        </form>
    </div>
    <!-- </section> -->
</div>