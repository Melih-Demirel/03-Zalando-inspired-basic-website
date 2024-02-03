<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Account <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container d-flex flex-column align-items-center h-100">
    <?= view('components/navbarAccount', ['navbar' => $navbar]); ?>
    <div class="container align-items-center w-75 mt-5">
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Name</p>
            <p class="fs-6 customPBreakWord"><?= $customer['name'] ?></p>
        </div>
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Name</p>
            <p class="fs-6 customPBreakWord"><?= $customer['surname'] ?></p>
        </div>
        <div class="border-bottom mb-3">
            <p class="fw-bold fs-5">Email</p>
            <p class="fs-6 customPBreakWord"><?= $customer['email'] ?></p>
        </div>
        <div class="border-bottom mb-4">
            <p class="fw-bold fs-5">Password</p>
            <p class="fs-6">****</p>
        </div>
    </div>
</div>
<?= $this->endSection()?>
