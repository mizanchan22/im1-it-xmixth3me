<?= $this->include('layouts/top_layout') ?>
<?php if (!empty($sidebar_layout)) : ?>
    <?= $this->include($sidebar_layout) ?>
<?php else : ?>
    <?= $this->include('layouts/sidebar_layout') ?>
<?php endif ?>
<main id="main" class="main">
    <?php echo view($view, $data) ?> 
</main><!-- End #main -->
<?= view('layouts/bottom_layout') ?>

