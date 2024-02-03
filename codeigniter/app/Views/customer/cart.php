<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Cart <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-md mt-5 px-5 pt-2 ">
    <div class="row justify-content-around">
        <div class="col-12 col-md-8 border rounded pt-3 px-5 mb-5">
            <h2 class="pb-2 mb-4">Cart (<?= count($items); ?>)</h2>
            <div class="container p-0">
                <div class="row">
                    <?php foreach($items as $cart_item): ?>
                        <?= view('/components/cartItem', $cart_item); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="mt-sm-3 mt-md-0 col-12 col-md-3 border rounded pt-3 pb-5" style="height: fit-content;">
            <h2 class="pb-2">Totalprice</h2>
            <div class="d-flex flex-row justify-content-between">
                <p> Subtotal:</p>
                <p> € <?= $totalPrice ?></p>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <p> Shipping: </p>
                <p>€ 0.00</p>
            </div>
            <hr> 
            <div class="d-flex flex-row fw-bold justify-content-between">
                <p>Totalprice</p>
                <p><?= $totalPrice ?> €</p>
            </div>
            <a href="<?= base_url() ?>/order" class="text-decoration-none text-reset">
                <button class="customButton py-2 btn border-success  btn-success btn-outline-success">Continue</button>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection()?>
<?= $this->section('scripts') ?>
    <script src="/assets/js/ajax/cart.js"></script>
<?= $this->endSection(); ?>