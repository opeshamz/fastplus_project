<?php

if (count($sucess) > 0) : ?>
    <div class="sucess" style="color: green; text-align:center;">
        <?php foreach ($sucess as $sucess) : ?>
            <h4><?php echo $sucess ?></h4>
        <?php endforeach ?>
    </div>
<?php endif ?>