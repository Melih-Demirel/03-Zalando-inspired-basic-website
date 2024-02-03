<?= $this->extend('/layouts/main') ?>

<?= $this->section('title') ?> Notifications <?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container d-flex flex-column align-items-center h-100">
    <?= view('components/navbarAccount', ['navbar' => $navbar]); ?>
    <div class="container align-items-center w-75 mt-5 mb-5">
        <ul class="list-group d-flex flex-column-reverse">
                        <?php foreach ($notifications as $notification) : ?>
                            <li class="list-group-item py-3 d-flex flex-row align-items-center border rounded mb-1">
                                <div class="d-flex flex-column px-3 w-100">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted"> 
                                            <?= date("jS M Y",strtotime($notification['added_at'])); ?> 
                                        </span> 
                                        <span class="text-muted"> 
                                            <?php echo ($notification['viewed'] ? 'Read' : 'Not Read' ) ?>
                                         </span>
                                    </div>
                                    <h6 class="d-inline"><?= $notification['seller'] ?></h6>
                                    <span>
                                        <?= $notification['text'] ?>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    
                    </ul>
    </div>
</div>
<?= $this->endSection()?>