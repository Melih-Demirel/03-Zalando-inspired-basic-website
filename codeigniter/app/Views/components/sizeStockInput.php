<div id="<?= $key ?>">
    <div class="row my-2">
        <div class="col my-1 mx-1 w-100">
            <input type="text" name="size[]" id="size" class="customInput" placeholder="S" required value="<?= $item['size'] ?>">
        </div>
        <div class="col my-1 mx-1 w-100">
            <input type="number" name="stock[]" id="stock" class="customInput" placeholder="0" min="0" required value="<?= $item['stock'] ?>">
        </div>
        <div class="my-1 mx-1 col-auto">
            <button type="button" class="fw-bolder border-danger btn btn-outline-danger" onclick="removeSize(event,<?= $key ?>)">Remove</button>
        </div>
    </div>
</div>