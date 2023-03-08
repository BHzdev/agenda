<?php
include_once("templates/header.php");
?>
<div class="container">
  <?php if (isset($printMsg) && $printMsg != '') : ?>
    <p id="msg"><?= $printMsg ?></p>
  <?php endif; ?>
</div>
<?php
include_once("templates/footer.php");
?>