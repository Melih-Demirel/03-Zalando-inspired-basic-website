<?= $this->extend('/layouts/order.php') ?>
<?= $this->section('orderContent') ?>
<div class="container-fluid align-items-center justify-content-center text-center">
    <h3>Ordered succesfully!</h3>
</div>

<a href="/">
    <button class="customButton py-2 border-2 mt-3 btn border-primary  btn-primary btn-outline-primary"> Return to homepage </button>
</a>
<?= $this->endSection()?>