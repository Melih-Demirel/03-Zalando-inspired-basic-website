<?php for($i = 0; $i < $rating; ++$i) : ?>
    <i class="bi bi-star-fill prefColor"></i>        
<?php endfor; ?>
<?php if ($rating == 0) : ?>
    <?php for($i = 0; $i < 5; ++$i) : ?>
        <i class="bi bi-star prefColor"></i>        
    <?php endfor; ?>
<?php endif; ?>