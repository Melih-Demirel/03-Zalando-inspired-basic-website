<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Edit Product <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid d-flex flex-column align-items-center h-100">
            <h2 class="mt-4 fw-bold">Edit Product</h2>   
            <form action="<?= base_url() ?>/products/edit/<?= $product['product']['product_id'] ?>" method="POST" enctype="multipart/form-data" class="w-50">
                <?= csrf_field('csrf') ?>
                <div class="my-2">
                    <div class="my-3">
                        <label for="name" class="customLabel mb-1">Product name</label>
                        <input type="text" name="name" id="name" class="customInput" placeholder="Product name" value="<?= $product['product']['name']?>" required>
                    </div>
                    <div class="my-3">
                        <label for="price" class="customLabel mb-1">Price</label>
                        <input type="number" min="0" step="0.01" name="price" value="<?= $product['product']['price']; ?>" id="price" class="customInput" placeholder="00.00"  required>
                    </div>
                    <div class="my-3">
                        <label for="category" class="customLabel mb-1">Category</label>
                        <select name="category" id="category" class="customInput py-2">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['category_id'] ?>" <?php echo ($category['category_id'] == $product['product']['category_id'] ? "selected" : "") ?>> <?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="description" class="customLabel mb-1">Description</label>
                        <textarea name="description" id="description" class="customInput" placeholder="Description" rows="4" required><?= $product['product']['description'] ?></textarea>
                    </div>
                    <div class="my-3">
                        <label for="images" class="customLabel mb-3">Images</label>
                        <div id="imageContainer" class="container-fluid row my-2">
                            <?php foreach($product['images'] as $image): ?>
                                <?= view('/components/sellerImage', ['image' => $image]) ?>
                            <?php endforeach; ?>
                        </div>
                        <input type="file" name="images[]" id="images" class="form-control-file mb-3" accept="image/jpeg" multiple>
                    </div>
                    <div class="my-3">
                        <label for="videos" class="customLabel mb-3">Videos</label>
                        <div id="videoContainer" class="container my-2">
                            <?php foreach($product['videos'] as $key => $video): ?>    
                                <?= view('/components/videoInput', ['video' => $video, 'key' => $key]) ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="container w-50">
                            <button class="customButton btn btn-outline-primary border-primary w-100" id="addVideo">Add New Video URL</button>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="Size" class="customLabel mb-3">Size & Stock</label>
                        <div id="sizeStockContainer" class="container">
                            <?php foreach($product['items'] as $key => $item): ?>
                                <?= view('/components/sizeStockInput', ['item' => $item, 'key' => $key]) ?>
                            <?php endforeach ?>
                        </div>
                        <div class="container w-50">
                            <button class="customButton btn btn-outline-primary border-primary w-100 mt-3" id="addSize">Add New Size</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="customButton py-2 btn-outline-danger  fw-bolder border-danger mt-3" onclick="removeProduct(event, <?= $product['product']['product_id'] ?>)">Delete Product</button>
                <button type="submit" class="customButton py-2 btn-outline-success fw-bolder border-success mb-5 mt-3">Save</button>
            </form>
</div>

<?= $this->endSection()?>
<?= $this->section("scripts") ?>
<script src="/assets/js/util/size.js"></script>
<script src="/assets/js/util/video.js"></script>
<script src="/assets/js/ajax/removeProductImage.js"></script>
<script src="/assets/js/ajax/removeProduct.js"></script>
<?= $this->endSection() ?>