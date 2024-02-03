<?= $this->extend('/layouts/email') ?>
<?= $this->section('content') ?>
<div>
    <h1> Verify email:</h1>
    <p>Verify your email <a href="<?= base_url() ?>/auth/verify/<?= $token ?>">here</a>.</p>
</div>
<?= $this->endSection()?>
