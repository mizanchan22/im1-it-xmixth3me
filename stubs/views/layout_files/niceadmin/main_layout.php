<?= $this->include('layouts/top_layout') ?>
<?= $this->include('layouts/sidebar_layout') ?>
<main id="main" class="main">
    <?= $this->renderSection('content') ?>
</main><!-- End #main -->
<?= view('layouts/bottom_layout') ?>

