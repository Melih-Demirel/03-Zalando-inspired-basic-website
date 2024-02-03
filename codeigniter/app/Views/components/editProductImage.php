<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
    <div class="card shadow-lg mx-auto bg-light h-100">
        <?php if ($image['img']): ?>
        <img src="<?php echo 'data:image/jpg;base64,' . base64_encode($image['img']); ?>" class="card-img-top"
            alt="Product image" />
        <?php endif; ?>
        <div class="card-body h-100 d-flex flex-column justify-content-end">
            <button class="btn btn-outline-danger py-2" onclick="removeImage(event, <?= $image['img_id'] ?>)">Remove</button>    
        </div>
        
    </div>
</div>

