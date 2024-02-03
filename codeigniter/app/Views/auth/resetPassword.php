<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Reset password <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-5">
    <div class="container text-center align-items-center justify-content-center p-5 w-50">
        <h3>Reset your password?</h3>
        <p>
            Enter your password below.
        </p>
        <form action="<?= base_url() ?>/auth/reset-password/<?= $user_id?>" method="POST" class="mt-4">
            <?= csrf_field('csrf') ?>
            <div class="my-3">
                <label for="password" class="customLabel mb-1 text-start">New password</label>
                <input type="password" name="password" id="password" class="customInput" placeholder="●●●●">
            </div>
            <button class="customButton py-2 btn border-success  btn-success btn-outline-success"> Confirm </button>
        </form>

    </div>
</div>
<?= $this->endSection()?>
