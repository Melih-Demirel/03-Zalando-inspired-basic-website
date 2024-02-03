<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?><?= $product_data['product']['seller'] ?> <?= $product_data['product']['name'] ?><?= $this->endSection()?>
<?= $this->section('content') ?>
<input id="bg_color" hidden disabled value="<?= $product_data['bg_color'] ?>">
<input id="text_color" hidden disabled value="<?= $product_data['text_color'] ?>">
<div class="prefBg">
    <div class="container-fluid mt-5 px-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-3 p-0 mb-4">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <?php  for ($i = 0; $i < count($product_data['images']); $i++) : ?>
                            <div class="carousel-item <?php if ($i == 0) echo('active'); ?>">
                                <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($product_data['images'][$i]['img']); ?>"
                                    class="d-block w-100" alt="product-img">
                            </div>
                        <?php endfor; ?>
                        <?php for($i = 0; $i < count($product_data['videos']); $i++) : ?>
                            <div class="carousel-item <?php if ($i + count($product_data['images']) == 0) echo('active'); ?>">
                                <iframe src="<?= $product_data['videos'][$i]['video_url'] ?>"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="w-100 h-100"></iframe>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-5 ps-md-5">
                <a href="<?= base_url() ?>/seller/profile/<?= $product_data['product']['seller_id'] ?>"
                    class="text-decoration-none text-reset d-block"><h1 class="fs-5 fw-bolder prefColor"><?= $product_data['product']['seller'] ?></h1></a>
                <span class="d-block fs-2 fw-normal  prefColor"><?= $product_data['product']['name'] ?></span>
                <span class="fs-4 fw-bold my-2  prefColor">€ <?= $product_data['product']['price'] ?></span>
                <div class="my-2">
                    <?= view('components/rating', ['rating' => $product_data['rating']]); ?>
                </div>
                <?php if($isCustomer){ ?>
                    <div>
                        <input type="hidden" id="product_id" value="<?= $product_data['product']['product_id'] ?>">
                        <label for="size" class="fw-bolder fs-4 prefColor mb-2">Choose size</label>
                        <select name="size" id="size" class="customInput mb-3 fw-bold prefColor prefBorder prefBg" style="outline:none;">
                            <?php foreach($product_data['items'] as $item) : ?>
                            <option value="<?= $item['product_inventory_id'] ?>" class="prefColor prefBg"> <?= $item['size'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex">
                        <button id="addToCart" style="width:90%;border-radius: 20px;border: 3px solid #111316;" class="btn prefButton me-1 fw-bolder">Add to cart</button>
                        <button id="addToWishlist" style="border-radius: 20px;border: 3px solid #111316;" class="btn prefBg prefBorder w-auto flex-grow-1 fw-bolder">
                            <i class="bi bi-heart prefColor fw-bolder"></i>
                        </button>
                    </div>
                    <div class="mt-5 mb-5">
                        <h4 class="prefColor">Reviews (<?= count($product_data['reviews']); ?>)</h4>
                        <div class="container-fluid px-1">
                            <?php foreach($product_data['reviews'] as $review) : ?>
                            <?= view('components/reviewItem', $review) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>

<?= $this->section("scripts") ?>
<script src="/assets/js/ajax/addToCart.js"></script>
<script src="/assets/js/ajax/addToWishlist.js"></script>
<script src="/assets/js/util/loadColors.js"></script>
<?= $this->endSection()?>