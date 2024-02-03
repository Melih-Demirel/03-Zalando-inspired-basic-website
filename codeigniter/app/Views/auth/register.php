<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?>Register<?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="d-flex flex-column justify-content-center align-items-center  h-100 mb-5">
    <h3>I'm a</h3>
    <div class="row justify-content-between pt-4 w-50 pb-5 px-md-5">
        <div class="col-12 col-md-6">
            <a href="<?= base_url() ?>/auth/register/seller"><button class="customButton py-2 w-100 btn border-primary  btn-primary btn-outline-primary">seller</button></a>
        </div>
        <div class="col-12 col-md-6 mt-xl-0 mt-3 mt-lg-0 mt-md-0">
            <a href="<?= base_url() ?>/auth/register/customer">
                <button class="customButton py-2 w-100 btn border-primary  btn-primary btn-outline-primary">customer</button>    
            </a>    
        </div>
    </div>
</div>
<?= $this->endSection()?>
