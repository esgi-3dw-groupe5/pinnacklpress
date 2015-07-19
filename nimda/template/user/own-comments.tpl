<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Article</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Mise a jour</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($this->viewData->comments as $key => $value) : ?>
                    <tr>          
                        <td><?php $this->show($value, 'com_id')      ?></td>
                        <td><?php $this->show($value, 'post_id')    ?></td>
                        <td><?php $this->show($value, 'com_content')    ?></td>
                        <td><?php $this->show($value, 'com_date')    ?></td>
                        <td><?php $this->show($value, 'com_update')  ?></td>
                        <td><?php echo($this->get($value, 'com_active') == '1' ? 'Active' : 'Desactive'); ?></td>
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
                window.location = Sophwork.getUrl() + "nimda/posts";
            }
        }
    })();
});
</script>