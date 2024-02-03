<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Orders <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container d-flex flex-column align-items-center h-100">
    <?= view('components/navbarAccount', ['navbar' => $navbar]); ?>
    <div class="w-75 mt-5 pb-5">
        <?php foreach ($orders as $order) : ?>
            <?php if ($order['items'] != NULL && count($order['items'])) : ?>
                <div class="py-3 px-3 col-12 mb-3 border border-dark rounded">
                    <p class="fs-5 fw-bolder">Ordernumber: <?= $order['order'] ?></p>
                    <div class="row mt-3">
                        <div class="col-3">
                            <h6 class="fs-6 fw-bolder">Order date</h6>
                            <p> <?= date("jS M Y",strtotime($order['order_date'])) ?> </p>
                        </div>
                        <div class="col-3">
                            <h6 class="fs-6 fw-bolder">Total</h6>
                            <p>€ <?= $order['totalPrice'] ?></p>
                        </div>
                        <div class="col-3">
                            <h6 class="fs-6 fw-bolder">Type</h6>
                            <p> <?= $order['type'] ?> </p>
                        </div>
                        <div class="col-3">
                            <h6 class="fs-6 fw-bolder">Payment</h6>
                            <p>Completed</p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php foreach ($order['items'] as $item) : ?>
                                <?= view('components/orderItem', $item); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section("scripts") ?>
    <script src="/assets/js/ajax/orderActions.js"></script>
<?= $this->endSection()?>