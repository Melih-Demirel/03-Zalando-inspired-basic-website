<li>
    <input type="checkbox" value="<?=$brand['seller_id']?>" id="seller-<?=$brand['seller_id']?>" name="seller[]"
        <?php if($checked) { ?>checked<?php } ?>
    >
    <label for="seller-<?=$brand['seller_id']?>">
        <?= $brand['name'] ?>
    </label>
</li>