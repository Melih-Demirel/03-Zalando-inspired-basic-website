<div id="<?= $key ?>">
    <div class="input-group mb-3">
        <input type="text" name="video[]" id="video" class="customInput border form-control"
            placeholder="https://youtu.be/eIoZxhBKA7c" required value="<?= $video['video_url'] ?>">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">
                <i type="button" role="button" class="bi bi-trash fs-4" 
                    style="color:red;" onclick="removeVideo(event,<?= $key ?>)">
                </i>
            </span>
        </div>
    </div>
</div>