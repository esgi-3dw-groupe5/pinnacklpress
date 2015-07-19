<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
                <?php foreach ($this->viewData->pages as $key => $value) : ?>

                    <div class="thumb-article-user">
                        <h2>  <?php $this->show($value, 'page_name')      ?></h2>

                        <p><?php $this->show($value, 'page_udate')    ?></p>
                    </div>
               
                <?php endforeach; ?>
            </table>
        </div>
    <!-- </section> -->
</div>