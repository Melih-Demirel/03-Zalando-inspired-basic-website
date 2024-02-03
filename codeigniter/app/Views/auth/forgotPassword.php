<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Reset password <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100 w-100 py-4">
    <div class="container text-center align-items-center justify-content-center p-4 w-50">
        <h3>Reset password</h3>
        <form action="" method="POST" class="mt-4">
            <?= csrf_field('csrf') ?>
            <div class="my-3">
                <label for="email" class="customLabel mb-1 text-start">Email Address</label>
                <input type="text" name="email" id="email" class="customInput" placeholder="Your email">
            </div>
            <button class="customButton py-2 fw-bolder"> Reset password</button>
        </form>
    </div>
</div>

<?= $this->endSection()?>
