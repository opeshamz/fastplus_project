<?php

if (count($sucess) > 0) : ?>
	<div class="sucess" style="color: green; text-align:center;">
		<?php foreach ($sucess as $sucess) : ?>
			<p><?php echo $sucess ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>