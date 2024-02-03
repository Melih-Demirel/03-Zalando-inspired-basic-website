<?= $this->extend('/layouts/order.php') ?>
<?= $this->section('orderContent') ?>
<div class="container-fluid">
            <div class="row justify-content-between px-0">
                <div class="col-6 ps-0">
                    <button role="button" id="deliveryBtn" class="d-flex flex-column align-items-center customButton btn btn-primary btn-outline-primary border-primary">
                        <p class="fs-4 pt-3">Delivery</p>
                    </button>
                    
                </div>
                <div class="col-6 pe-0">
                    <button role="button" id="pickUpBtn" class="d-flex flex-column align-items-center customButton btn btn-primary btn-outline-primary border-primary">
                        <p class="fs-4 pt-3">Pick-up</p>
                    </button>
                </div>
                
            </div>
        </div>
        <form action="<?= base_url() ?>/order/success" method="GET" >
            <div id="pickUp" class="mt-3">
                <input type="hidden" name="type" value="Pick Up">
                <div>
                    <label for="deliveryDate" class="customLabel mb-1 fw-bolder">Pick up date</label>
                    <input type="datetime-local" name="delivery_date" id="deliveryDate" class="customInput" required>
                </div>
            </div>
            <div id="delivery" class="mt-3 container-fluid d-none">
                <input type="hidden" name="type" value="Delivery">
                <div class="row">
                    <div class="col-12 p-0">
                        <label for="address" class="customLabel mb-1 fw-bolder">Address Line</label>
                        <input required type="text" name="address" id="address" class="customInput mb-2" placeholder="Herentalsebaan 173">
                        <label for="town" class="customLabel mb-1 fw-bolder">Town</label>
                        <input required type="text" name="town" id="town" class="customInput mb-2" placeholder="Brussel">
                        <label for="zipcode" class="customLabel mb-1 fw-bolder">Zip code</label>
                        <input required type="text" name="zipcode" id="zipcode" class="customInput w-25" placeholder="1180">
                    </div>
                </div>
            </div>
            <button class="customButton py-2 border-2 fw-bolder mt-3 border-success btn-success btn-outline-success" id="continueBtn">Continue</button>
        </form>
<?= $this->endSection()?>
<?= $this->section("scripts") ?>
<script src="/assets/js/util/pickOrderOption.js"></script>
<?= $this->endSection() ?>