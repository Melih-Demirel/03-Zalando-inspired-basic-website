<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Verify User <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3>Verify your email!</h3>
        <p>
            We've sent an email to <?= $email ?> to verify your email address. <br>
            If you haven't recieved an email click <a href="<?= base_url() ?>/auth/send-verification-mail/<?= $email ?>"> here</a>.<br>
        </p>
        <h3>For now click <a href="<?= base_url() ?>/auth/verify/<?= $token ?>">here</a>.<br> to proceed. SMTP Not Working After Google Update</h3>
    </div>
</div>
<?= $this->endSection()?>
