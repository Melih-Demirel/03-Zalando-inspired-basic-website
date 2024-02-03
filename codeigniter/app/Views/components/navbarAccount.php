<ul class="list-unstyled list-inline pt-2 mt-4">
    <?php for ($i=0; $i < count($navbar[0]); $i++) : ?> 
        <li class="list-inline-item px-1 <?php if($i == $navbar[1]) echo 'fw-bolder'; ?>">
            <a href="<?= base_url() . $navbar[0][$i]['href'] ?>" class="text-decoration-none text-reset"> <?= $navbar[0][$i]['value'] ?> </a>
        </li>    
    <?php endfor; ?>
</ul>
