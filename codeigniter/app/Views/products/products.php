<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Products <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid mt-5">
    <div class="row px-5">
        <?= view('/products/filter_sidebar', ['categories' => $categories, 'sellers' => $sellers, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice,
                                              'givenSearch' => $givenSearch, 'checkedCategories' => $checkedCategories, 'checkedSellers' => $checkedSellers, 
                                              'givenMinPrice' => $givenMinPrice, 'givenMaxPrice' => $givenMaxPrice]) ?>
        <div class="col-lg-10 col-sm-12 mt-4 mt-lg-0">
            <div class="container">
                <div class="row">
                    <?php foreach($products as $product) : ?>
                        <?= view('components/productItem', ['product' => $product, 'url' => '/products/']) ?>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>

</div>

<?= $this->endSection()?>