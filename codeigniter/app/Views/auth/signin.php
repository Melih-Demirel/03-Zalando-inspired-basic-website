<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?>Sign In<?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 mt-5">
    <h1 class="mt-4 mb-5 h2">Sign In</h1>
    <form action="" method="POST" class="w-50" id="signIn">
        <?= csrf_field('csrf') ?>

        <?php if (isset($validation)) : ?>
            <div class="alert text-center alert-danger" role="alert">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <div class="my-2">
            <label for="email" class="customLabel mb-2">Email</label>
            <input type="text" name="email" id="email" class="customInput" placeholder="Example: melih.demirel@student.uhasselt.be">
        </div>
        <div class="mb-4">
            <div class="d-flex flex-row justify-content-between">
                <label for="password" class="customLabel mb-2">Password</label>
            </div>
            <input type="password" name="password" id="password" class="customInput"
                placeholder="●●●●">
        </div>
        <button class="customButton px-4 py-2">SIGN IN</button>
        <div class="w-100 text-center mt-3">
            <p><a class="customRef" href="<?= base_url() ?>/auth/forgot-password">Forgot password?</a></p>
            <p><a class="customRef" href="<?= base_url() ?>/auth/register">Don't have an account yet?</a></p>
        </div>
    </form>
</div>

<?= $this->endSection()?>