<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?>Products<?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container d-flex flex-column justify-content-center align-items-center">
    <h2 class="mt-4 fw-bold">Products</h2>
    <a href="<?= base_url() ?>/seller/products/add" class="text-reset text-decoration-none mt-4 mb-4">
        <button class="btn btn-success">Add product</button>
    </a>
    <div class="container-fluid">
        <div class="row w-100">
            <?php foreach($products as $product) : ?>
                <?= view('components/productItem', ['product' => $product, 'url' => '/seller/products/']); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection()?>