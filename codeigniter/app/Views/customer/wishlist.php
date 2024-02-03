<?= $this->extend('/layouts/main') ?>

<?= $this->section('title') ?> Wishlist <?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container-fluid d-flex flex-column align-items-center mt-5 px-5 pt-2">
    <h1 class="mb-5 h2">Wishlist</h1>
    <div class="container-fluid w-75">
        <div class="row">
            <?php foreach($items as $favorite_item): ?>
                <?= view('components/productItem', ['product' => $favorite_item, 'url' => '/products/']); ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?= $this->endSection()?>