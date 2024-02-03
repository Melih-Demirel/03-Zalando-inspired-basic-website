<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Shop <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column justify-content-center align-items-center h-100">
  <a href="<?= base_url() ?>/products" class="text-reset text-decoration-none">
        <button class="customHomeButton btn border-primary  btn-primary btn-outline-primary">Shop Now</button>
  </a>   
</div>
<?= $this->endSection()?>
