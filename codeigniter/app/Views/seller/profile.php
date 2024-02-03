<?= $this->extend('/layouts/main') ?>

<?= $this->section('title') ?> <?= $seller['name'] ?> <?= $this->endSection()?>
<?= $this->section('content') ?>
<input id="bg_color" hidden disabled value="<?= $seller['bg_color'] ?>">
<input id="text_color" hidden disabled value="<?= $seller['text_color'] ?>">
<div class="prefBg">
    <div class="container mt-4 px-5 mb-5">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-3 p-0 mb-4 align-items-center justify-content-center">
                <?php if($seller['images']) { ?>
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <?php  for ($i = 0; $i < count($seller['images']); $i++) : ?>
                        <div class="carousel-item <?php if ($i == 0) echo('active'); ?>">
                            <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($seller['images'][$i]['img']); ?>"
                                class="d-block w-100" alt="product-img">
                        </div>
                        <?php endfor; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon prefColor" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon prefColor" aria-hidden="true"></span>
                    </button>
                </div>
                <?php  } ?>
            </div>
                
            </div>

            <div class="row">
                <div class="col-3">
                    <h3 class="prefColor"><?= $seller['name'] ?></h3>
                    <hr class="prefColor">
                    <div>
                        <p class="prefColor"> <?= $seller['description'] ?> </p>
                    </div>
                    <div>
                        <a href="<?= base_url() ?>/chat/<?= $seller['seller_id'] ?>" class="btn customButton py-1 prefButton">Chat
                            with seller</a>
                    </div>
                </div>

                <div class="col-9">
                    <div class="container">
                        <div class="row">
                            <?php foreach($products as $product) : ?>
                            <?= view('components/productItem', ['product' => $product, 'url' => '/products/']); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section('scripts') ?>
<script src="/assets/js/util/loadColors.js"></script>
<?= $this->endSection()?>