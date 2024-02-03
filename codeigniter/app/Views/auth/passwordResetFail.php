<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Reset Failed <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3>Oops something went wrong.</h3>
        <a href="<?= base_url() ?>/" class="text-reset text-decoration-none">
            <button class="customButton py-2 btn border-primary  btn-primary btn-outline-primary">Return to homepage</button>
        </a>
    </div>
</div>

<?= $this->endSection()?>