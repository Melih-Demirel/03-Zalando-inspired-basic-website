<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Shop <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid mt-5 px-5">
    <div class="container w-50 mt-2">
        <?= $this->renderSection('orderContent') ?>
    </div>
</div>
<?= $this->endSection()?>