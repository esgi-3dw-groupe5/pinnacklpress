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
                            <input type="radio" name="gender" value="1">
                        </label>
                        <label>Women
                            <input type="radio" name="gender" value="2">
                        </label>
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Pseudo</label>
                        <input type="text" name="pseudo" class="pinnackl-input-1-2" required>
                    </div> 
                    <div class="pinnackl-control-group">
                        <label>Email</label>
                        <input type="text" name="email" class="pinnackl-input-1-2" required>
                    </div>
                    
                    <div class="pinnackl-control-group">
                         <label>First name</label>
                        <input type="text" name="firstname" class="pinnackl-input-1-2">
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Last name</label>
                        <input type="text" name="lastname" class="pinnackl-input-1-2" required>
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Birthday</label>
                        <input type="date" name="bdate" class="pinnackl-input-1-2" >
                    </div>
                    <div class="pinnackl-control-group">
                        <label>Rôle</label>
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
            <div class="pinnackl-control-group">
                <label>Password</label>
                <input type="password" name="password" class="pinnackl-input-1-2" required>
            </div>
            <div class="pinnackl-control-group">
                <label>Confirm passwd</label>
                <input type="password" name="confirm" class="pinnackl-input-1-2" required>
            </div>
            <div class="pinnackl-controls-group" style="margin-top:30px;text-align:center">
                <input class="pinnackl-button pinnackl-button-primary" type="submit" name="" value="Submit">
            </div>
        </form>
    </div>
    <!-- </section> -->
</div>