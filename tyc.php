<?php
require_once "inc/config.php";
$tyc = DB::queryFirstRow("SELECT * FROM contenido WHERE id=%i", 1);
?>

<div class="info" id="terms">
    <?php echo utf8_encode($tyc['contenido']); ?>
</div>