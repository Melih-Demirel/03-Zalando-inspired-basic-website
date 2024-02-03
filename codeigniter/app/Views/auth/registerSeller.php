<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Register Seller<?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column align-items-center h-100">
    <h1 class="my-4 h2">I'm new here</h1>
    <form method="POST" action="<?= base_url() ?>/auth/register/seller" class="container-fluid w-50" enctype="multipart/form-data" >
        <?= csrf_field('csrf') ?>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="name" class="customLabel mb-1">Name</label>
            <input type="text" name="name" id="name" class="customInput" placeholder="Brand or business name">
        </div>
        
        <div class="mb-3">
            <label for="email" class="customLabel mb-1">Email</label>
            <input type="text" name="email" id="email" class="customInput" placeholder="Email">
        </div>
        
        <div class="mb-3">
            <label for="password" class="customLabel mb-1">Password</label> 
            <input type="password" name="password" id="password" class="customInput" placeholder="●●●●●">
        </div>
        
        <div class="mb-3">
            <label for="password_confirm" class="customLabel mb-1">Confirm Password</label> 
            <input type="password" name="password_confirm" id="password_confirm" class="customInput" placeholder="●●●●●">
        </div>
        
        <div class="mb-3">
            <label for="description" class="customLabel mb-1">Description</label>
            <textarea name="description" id="description" class="customInput" placeholder="Write a short description about your business." rows="5"></textarea>
        </div>
        
        <div class="mb-4">
            <label for="images" class="customLabel mb-1">Images to show on profile</label>
            <input type="file" name="images[]" id="images" accept="image/jpeg" multiple class="form-control-file">
        </div>
        
        <button class="customButton px-4 py-1 btn border-success  btn-success btn-outline-success">REGISTER</button>
        
        <div class="w-100 text-center mt-3">
            <p><a class="customRef" href="<?= base_url() ?>/auth/">Already have an account?</a></p>
        </div>
    </form>
</div>
<?= $this->endSection()?>
