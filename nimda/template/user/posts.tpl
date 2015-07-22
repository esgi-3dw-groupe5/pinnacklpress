<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
                <?php if(property_exists($this->viewData, 'pages_infos')){ foreach ($this->viewData->pages_info as $key => $value) : ?>

                    <div class="thumb-article-user">
                        <h2>  <?php $this->show($value, 'page_name')      ?></h2>
                        <div class="container-content">
                            <a class="articleLink" href="<?php $this->show($value, 'url');$this->show($value, 'page_tag') ?>">
                                 <?php $this->show($value,'content')      ?>
                             </a>

                        </div>  
                        
                    </div>
               
                <?php endforeach; }?>

            </table>
        </div>
    <!-- </section> -->
</div>