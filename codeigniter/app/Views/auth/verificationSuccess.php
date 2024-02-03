<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> User Verified <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3 class="mb-3">Verified!</h3>
        <a href="<?= base_url() ?>/auth" class="text-reset text-decoration-none">
            <button class="customButton py-2 btn btn-outline-primary border-primary">Sign In</button>
        </a>
    </div>
</div>
<?= $this->endSection()?>
