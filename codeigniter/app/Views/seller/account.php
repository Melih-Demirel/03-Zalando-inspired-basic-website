<?= $this->extend('/layouts/main') ?>

<?= $this->section('title') ?>Account<?= $this->endSection()?>

<?= $this->section('content') ?>

<div class="container d-flex flex-column align-items-center h-100 mt-5">
    <h3 class="fw-bold mb-4"> Personal Information </h3>
    <div class="w-75">
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Business Name</p>
            <p class="fs-6 customPBreakWord"><?= $seller['name'] ?></p>
        </div>
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Description</p>
            <p class="fs-6 customPBreakWord"><?= $seller['description'] ?></p>
        </div>
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Email</p>
            <p class="fs-6 customPBreakWord"><?= $seller['email'] ?></p>
        </div>
        <div class="border-bottom mb-4">
            <p class="fw-bold fs-5">Password</p>
            <p class="fs-6">****</p>
        </div>
        <div class="border-bottom mb-4">
            <p class="fw-bold fs-5">Background Color</p>
            <input type="color" disabled value="<?= $seller['bg_color'] ?>" />
        </div>
        <div class="border-bottom mb-4">
            <p class="fw-bold fs-5">Text Color</p>
            <input type="color" disabled value="<?= $seller['text_color'] ?>" />
        </div>
        <button type="button" class="customButton py-2 mb-5 btn btn-outline-primary border-primary" data-bs-toggle="modal" data-bs-target="#sellerModal" onclick="checkContrast();">Edit</button>
    </div>
</div>

        <div class="modal" id="sellerModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="staticBackdropLabel">Update your information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?=base_url() ?>/seller/edit" method="POST" enctype="multipart/form-data">
                        <?= csrf_field("csrf") ?>
                        <input type="hidden" name="seller" value="<?= $seller['seller_id'] ?>">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row py-2">
                                    <p class="customLabel">Business Images</p>
                                    <div id="imageContainer" class="container-fluid row my-2">
                                        <?php foreach($seller['images'] as $image): ?>
                                        <?= view('/components/sellerImage', ['image' => $image]) ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-center border-bottom mb-3">
                                    <input type="file" name="images[]" id="images" class="form-control-file mb-3" accept="image/jpeg" multiple>
                                </div>
                                <div class="border-bottom mb-3">
                                    <label for="name" class="customLabel mb-1">Business Name</label>
                                    <input type="text" name="name" id="name" class="customInput mb-3 mt-1"
                                        placeholder="Business name" 
                                        value="<?= $seller['name'] ?>">
                                </div>
                                <div class="border-bottom mb-3">
                                    <label for="description" class="customLabel mb-1">Description</label>
                                    <textarea name="description" id="description" class="customInput"
                                        placeholder="Description" rows="4"><?= $seller['description'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="bg_color" class="customLabel mb-1">Background Color</label>
                                    <input id="bg_color1" type="color" value="<?= $seller['bg_color'] ?>" oninput="checkContrast()" />
                                    <input id="bg_color" name="bg_color" type="text" value="<?= $seller['bg_color'] ?>"/>
                                </div>
                                <div class="mb-3">
                                    <label for="text_color" class="customLabel mb-1">Text Color</label>
                                    <input id="text_color1" type="color" value="<?= $seller['text_color'] ?>" oninput="checkContrast()" />
                                    <input id="text_color" name="text_color" type="text" value="<?= $seller['text_color'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="saveButton" disabled class="customButton py-2 btn btn-outline-success border-success">Save</button>
                        </div>
                    </form>
                </div>


    </div>

    <?= $this->endSection()?>
    <?= $this->section('scripts') ?>
    <script src="/assets/js/ajax/removeSellerImage.js"></script>
    <script src="/assets/js/util/colorContrastChecker.js"></script>
    <?= $this->endSection()?>