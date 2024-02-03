<li>
    <input type="checkbox" name="category[]" id="category-<?=$category['category_id']?>" value="<?= $category['category_id'] ?>"
        <?php if($checked) { ?>checked<?php } ?>
    >
    <label for="category-<?= $category['category_id'] ?>">
        <?= $category['name'] ?>
    </label>
</li>