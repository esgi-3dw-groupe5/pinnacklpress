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
            <th>Ttag</th>
            <th>Name</th>
            <th>Order</th>
            <th>Display</th>
            <th>Active</th>
            <th>Type</th>
            <th>Edit</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->viewData->pages as $key => $value) : ?>
        <tr>          
            <td><?php $this->show($value, 'page_id')      ?></td>
            <td><?php $this->show($value, 'page_tag')     ?></td>
            <td><?php $this->show($value, 'page_name')    ?></td>
            <td><?php $this->show($value, 'page_order')   ?></td>
            <td><?php $this->show($value, 'page_display') ?></td>
            <td><?php $this->show($value, 'page_active')  ?></td>
            <td><?php $this->show($value, 'page_type')    ?></td>
            <td>
                <a class="pinnackl-button pinnackl-button-primary"
                href="<?php $this->show('siteurl')?>nimda/pages/edit/<?php $this->show($value, 'page_tag')?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
    <!-- </section> -->
</div>
