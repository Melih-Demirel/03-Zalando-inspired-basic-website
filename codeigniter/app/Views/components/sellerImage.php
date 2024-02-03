<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3" id="<?= $image['img_id'] ?>">
    <div class="card shadow-lg mx-auto h-100">
        <div class="customButtonOnTopRight">
            <i role="button" class="bi bi-trash fs-4" style="color:red;" onclick="removeImage(event, <?= $image['img_id'] ?>)"></i>
        </div>
        <?php if ($image['img']): ?>
        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($image['img']); ?>" class="card-img-top"
            alt="Product Image" />
        <?php endif; ?>
    </div>
</div>

