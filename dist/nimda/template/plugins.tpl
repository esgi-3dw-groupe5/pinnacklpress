<div id="main">
	<div class="header">
		<h1><?php $this->show('h1') ?></h1>
		<h2><?php $this->show('h2') ?></h2>
	</div>
	<div class="content plugins">
		<div class="line">
			<?php foreach ($this->viewData->plugins as $key => $value) : ?>
			<div class="grid-2_4">
				<div style="background:#fff; border-radius:8px;overflow:hidden;margin:2em;margin-bottom:5%;">
					<header class="plugin-header <?php $this->e($value['type']) ?>">
						<?php $this->e($key, 'FU') ?>
					</header>
					<div class="plugin-body">
						Type : <?php $this->e($value['type'], 'FU') ?>
						<div style="text-align:right;">
							<a class="pinnackl-button pinnackl-button-primary" href="">Edit&nbsp;&#9998;</a>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>