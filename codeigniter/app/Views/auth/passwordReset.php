<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Reset Password <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3>Reset your password!</h3>
        <p>
            Email sent to <?= $email ?> to reset your password.<br>
        </p>
    </div>
</div>
<?= $this->endSection()?>