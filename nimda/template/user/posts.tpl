<div id="main">
    <div class="header">
        <h1><?php $this->show('h1') ?></h1>
        <h2><?php $this->show('h2') ?></h2>
    </div>

    <!-- <section> -->
        <div class="content">
                <?php foreach ($this->viewData->pages as $key => $value) : ?>
                <?php echo'<pre style="background:#ffffff">';
                var_dump($value);
                echo'</pre>';?>
                <?php endforeach; ?>
            </table>
        </div>
    <!-- </section> -->
</div>