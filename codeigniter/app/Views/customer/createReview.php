<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Submit Review <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid mt-5 px-5">
    <div class="d-flex flex-column align-items-center justify-content-center mb-4">
        <p class="fs-4 fw-bolder">Submit Review</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-3 p-0 mb-4">
            <img class="img-fluid shadow-lg" 
            src="<?php echo 'data:image/jpg;base64,' . base64_encode($images[0]['img']); ?>" alt="">
        </div>
        <div class="col-12 col-md-5 ps-md-5">
            <span class="d-block fs-2 fw-normal"><?= $product['name'] ?></span>
            <div>
                <input type="hidden" id="product_id" value="<?= $product['product_id'] ?>">
                <label for="rating" class="fw-bolder">Rating</label>
                <select name="rating" id="rating" class="customInput mb-3 " required>
                    <?php for($i =0; $i <= 5; $i++) : ?>
                        <option value="<?= $i ?>"> <?= $i ?> </option>        
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label for="comment" class="fw-bolder">Comment</label>
                <textarea  name="comment" id="comment" class="customInput mb-3 "></textarea>
            </div>
            <button id="createReview" class="customButton py-2 me-1 btn-outline-primary fw-bolder border-primary" onclick="createReview()">Create Review</button>    
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section("scripts") ?>
<script src="/assets/js/ajax/createReview.js"></script>
<?= $this->endSection()?>