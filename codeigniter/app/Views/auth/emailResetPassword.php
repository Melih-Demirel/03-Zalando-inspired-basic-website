<?= $this->extend('/layouts/email') ?>
<?= $this->section('content') ?>
<div >
    <h1> Password Reset:</h1>
    <p>Click <a href="<?= base_url() ?>/auth/recover-user/<?= $token ?>"> link </a> to reset password.</p>
</div>
<?= $this->endSection()?>
