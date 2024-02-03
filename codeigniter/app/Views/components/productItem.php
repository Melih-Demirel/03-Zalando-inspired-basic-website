<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card shadow mx-auto h-100 prefBg prefBorder">
        <?php if ($product['img']): ?>
        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($product['img']); ?>" class="card-img-top"
            alt="<?php $product['name'] ?>" />
        <?php endif; ?>
        <a class="text-decoration-none h-100" href="<?= base_url() . $url . $product['product_id']?>">
            <div class="card-body d-flex flex-column h-100">
                <div class="justify-content-between flex-row mt-auto">
                    <p class="fs-6 fw-bold prefColor"><?= $product['seller'] ?></p>
                    <p class="fs-6 fw-bold prefColor"><?= $product['name'] ?></p>
                    <p class="fw-bold prefColor">€ <?= $product['price'] ?></p>
                </div>
            </div>
        </a>
        
    </div>
</div>