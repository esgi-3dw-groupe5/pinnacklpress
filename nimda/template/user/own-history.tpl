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
                        <th>Articles read</th>
                        <th>Categories</th>
                        <th>Author</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($this->viewData->history as $key => $value) : ?>
                    <tr>          
                        <td><?php $this->show($value, 'history_id')      ?></td>
                        <td><?php $this->show($value, 'post_id')    ?></td>
                        <td><?php $this->show($value, 'history_date') ?></td>
                        <td><?php $this->show($value, 'history_status') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!-- </section> -->
</div>