<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 my-2 container">
    <div class="card shadow mx-auto h-100">
        <?php if ($images[0]['img']): ?>
        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($images[0]['img']); ?>"
            alt="product-image">
        <?php endif; ?>
        <a class="text-decoration-none h-100" href="<?= base_url() ?>/products/<?= $product ?>">
            <div class="card-body d-flex flex-column h-100">
                <div class="justify-content-between flex-row mt-auto">
                    <p class="fs-6"><?= $seller ?></p>
                    <?php if ($order_status == 'Completed') { ?>
                        <button type="button" class="mt-2 mb-2 customButton btn-outline-primary border-primary w-100">
                            <a href="<?= base_url() ?>/review/create/<?= $product ?>" class="text-reset text-decoration-none">Write Review</a>
                        </button>
                    <?php } ?>
                    <?php if ($order_status == 'Ordered') { ?>
                        <button onclick="cancelOrder(<?= $order_item_id ?>)" type="button" class="mt-2 customButton fw-bolder border-danger btn-outline-danger w-100">Cancel Order</button>
                    <?php } else { ?>
                        <p class=" <?php echo ($order_status == 'Cancelled' ? 'text-danger' : 'text-success') ?> fw-bolder"> <?= $order_status ?> </p>
                    <?php } ?>
                </div>
            </div>
        </a>
    </div>
</div>