<div class="row pt-3">
    <div class="col-12 prefBorder py-1" style="border-radius: 20px;border: 3px solid #111316;">
        <div class="d-flex flex-row justify-content-between">
            <span class="d-block pt-1 pb-2 prefColor"><?= date("jS M Y",strtotime($created_at)); ?></span>
            <div>
                <?= view('components/rating', ['rating' => $rating]); ?>
            </div>
        </div>
        <span class="fs-5 prefColor"> <?= $name . ' ' . $surname ?></span>
        <p class="fs-5 prefColor"> <?= $comment ?> </p>
    </div>
</div>