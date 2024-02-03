<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card shadow mx-auto h-100 prefBg prefBorder">
        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($img);?>" class="card-img-top"
            alt="<?= $name ?>" />
        <a class="text-decoration-none h-100" href="<?= base_url() ?>/products/<?= $product_id ?>">
            <div class="card-body d-flex flex-column h-100">
                <div class="justify-content-between flex-row mt-auto">
                    <p class="card-text mb-1 fw-bold"> <?= $name ?> </p>
                    <p class="card-text mb-1 fw-bold">Size : <?= $size ?> </p>
                    <p class="card-text mb-1 fw-bold">Amount : <?= $amount ?> </p>
                    <p class="card-text mb-3 fw-bold"> € <?= $price ?> </p>
                    <p class="card-text mb-4 mb-lg-0 mb-md-0 mb-xl-0" >
                        <button class="btn btn-danger border-danger mb-2"   onclick="deleteCartItem(<?= $cart_item_id ?>)">Remove</button>
                    </p>
                </div>
            </div>
        </a>
        
    </div>
</div>