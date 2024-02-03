<div class="col-12 col-lg-2 d-flex flex-column px-5 px-md-3 px-lg-3">
    <h3>FILTER</h3>
    <form action="<?= base_url() ?>/products/filter" method="GET">
        <div class="pt-2 pb-3">
            <span class="fw-bold">Search</span>
            <input type="text" class="customInput  py-1 text-center" name="search" value="<?= $givenSearch ?>"placeholder="Search">
        </div>

        <div class="">
            <span class="fw-bold w-100 d-flex justify-content-between">
                Categories
                <a class="text-reset text-decorations-none text-black" data-bs-toggle="collapse"
                    href="#CategoriesSection" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-chevron-down"></i>
                </a>
            </span>

            <div class="collapse show" id="CategoriesSection">
                <ul class="list-unstyled">
                    <?php foreach ($categories as $category) : ?>
                    <?php if(is_array($checkedCategories)){ ?>
                    <?php   if(in_array($category['category_id'], $checkedCategories)){?>
                                <?= view('components/filterCategory', ['category' => $category, 'checked' => true]) ?>
                    <?php    } else {?>
                                <?= view('components/filterCategory', ['category' => $category, 'checked' => false]) ?>
                    <?php    } ?>
                    <?php } else {?>
                                <?= view('components/filterCategory', ['category' => $category, 'checked' => false]) ?>
                    <?php }?> 
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="">
            <span class="fw-bold w-100 d-flex justify-content-between">
                Sellers
                <a class="text-reset text-decorations-none text-black" data-bs-toggle="collapse" href="#StoreSection"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-chevron-down"></i>
                </a>
            </span>

            <div class="collapse show" id="StoreSection">
                <ul class="list-unstyled">
                    <?php foreach ($sellers as $brand) : ?>
                    <?php if(is_array($checkedSellers)){ ?>
                    <?php   if(in_array($brand['seller_id'], $checkedSellers)){?>
                                <?= view('components/filterBrand', ['brand' => $brand, 'checked' => true]) ?>
                    <?php    } else {?>
                                <?= view('components/filterBrand', ['brand' => $brand, 'checked' => false]) ?>
                    <?php    } ?>
                    <?php } else {?>
                                <?= view('components/filterBrand', ['brand' => $brand, 'checked' => false]) ?>
                    <?php }?> 
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        

        <div class="">
            <span class="fw-bold">Price</span>

            <div class="row justify-content-between py-2">
                <div class="col-6">
                    <input type="number" min="<?= $minPrice ?>" max="<?= $maxPrice?>" placeholder="<?= $minPrice ?>" value="<?= $givenMinPrice ?>" class="customInput mw-50  py-1 text-center" name="minPrice">
                </div>
                <div class="col-6">
                    <input type="number" min="<?= $minPrice ?>" max="<?= $maxPrice ?>" placeholder="<?= $maxPrice ?>" value="<?=$givenMaxPrice?>" class="customInput mw-50  py-1 text-center" name="maxPrice">
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button class="customButton py-1 btn-outline-primary fw-bolder border-primary"> Filter </button>
        </div>
    </form>

</div>