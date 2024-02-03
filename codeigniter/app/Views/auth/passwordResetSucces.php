<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Reset Success <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3>Password changed successfully.</h3>
        <a href="<?= base_url() ?>/auth/" class="text-reset text-decoration-none">
            <button class="customButton py-2 btn border-primary  btn-primary btn-outline-primary">Sign in</button>
        </a>
    </div>
</div>

<?= $this->endSection()?>