<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Add Product <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid d-flex flex-column align-items-center h-100">
            <h2 class="mt-4 fw-bold">Add Product</h2>
            <form action="<?= base_url() ?>/products/add" method="POST" enctype="multipart/form-data" class="w-50">
                <?= csrf_field('csrf') ?>
                <input type="text" hidden name="seller" value="<?= session()->get('roleId') ?>">
                <div class="my-2">
                    <div class="my-3">
                        <label for="name" class="customLabel mb-1">Product name</label>
                        <input type="text" name="name" id="name" class="customInput" placeholder="Product name" required>
                    </div>
                    <div class="my-3">
                        <label for="price" class="customLabel mb-1">Price</label>
                        <input type="number" min="0" step="0.01" name="price" id="price" class="customInput" placeholder="00.00"  required>
                    </div>
                    <div class="my-3">
                        <label for="category" class="customLabel mb-1">Category</label>
                        <select name="category" id="category" class="customInput py-2">
                            <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['category_id'] ?>"> <?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="description" class="customLabel mb-1">Description</label>
                        <textarea name="description" id="description" class="customInput" placeholder="Description" rows="4" required></textarea>
                    </div>
                    <div class="my-3">
                        <label for="images" class="customLabel mb-3">Images</label>
                        <input type="file" name="images[]" id="images" class="form-control-file mb-3" accept="image/jpeg" multiple>
                    </div>
                    <div class="my-3">
                        <label for="videos" class="customLabel mb-3">Videos (embed version)</label>
                        <div id="videoContainer" class="container my-2">
                        </div>
                        <div class="container">
                            <button class="customButton btn btn-outline-primary border-primary w-100" id="addVideo">Add New Video URL</button>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="Size" class="customLabel mb-3">Size & Stock</label>
                        <div id="sizeStockContainer" class="container">
                            <div id="0">
                                <div class="row my-2">
                                    <div class="col my-1 mx-1 w-100">
                                        <input type="text" name="size[]" id="size" class="customInput" placeholder="S" required>
                                    </div>
                                    <div class="col my-1 mx-1 w-100">
                                        <input type="number" name="stock[]" id="stock" class="customInput" placeholder="0" min="0" required>
                                    </div>
                                    <div class="my-1 mx-1 col-auto">
                                        <button type="button" class="fw-bolder border-danger btn btn-outline-danger disabled" onclick="removeSize(event,0)">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <button type="button" class="customButton btn btn-outline-primary border-primary w-100 mt-3" id="addSize">Add New Size</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="customButton py-2 btn-outline-success fw-bolder border-success mb-5 mt-3">Save</button>
            </form>
</div>

<?= $this->endSection()?>


<?= $this->section("scripts") ?>

<script src="/assets/js/util/size.js"></script>
<script src="/assets/js/util/video.js"></script>

<?= $this->endSection() ?>