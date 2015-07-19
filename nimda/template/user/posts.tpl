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
                        <div class="container-img">
                            <img src="">
                        </div>
                        <ul>
                            <span>Categories :</span>
                            <?php foreach ($this->viewData->category as $key => $value) : ?>
                                <li>
                                    <?php $this->show($value, 'page_name') ?>,
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="container-content">
                            <label>
                                 <?php $this->show('page_content')      ?>
                            </label>
                        </div>  
                        
                    </div>
               
                <?php endforeach; ?>

            </table>
        </div>
    <!-- </section> -->
</div>