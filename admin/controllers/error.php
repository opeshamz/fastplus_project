<?php
if (count($error) > 0) : ?>
    <div class="" style="color: red;  text-align:center ;">
        <?php foreach ($error as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>