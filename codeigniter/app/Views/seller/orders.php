<?= $this->extend('/layouts/main') ?>
<?= $this->section('title') ?> Orders <?= $this->endSection()?>
<?= $this->section('content') ?>
<div class="container-fluid d-flex flex-column align-items-center h-100 w-75">
            <h2 class="mt-4 fw-bold mb-4">Orders</h2>   
            <table class="table table-striped">
                <thead class="py-2">
                    <tr class="py-2">
                        <th scope="col" class="fw-bolder">Ordernumber</th>
                        <th scope="col" class="fw-bolder">Order Item Id</th>
                        <th scope="col" class="fw-bolder">Product</th>
                        <th scope="col" class="fw-bolder">Customer</th>
                        <th scope="col" class="fw-bolder">Order Date</th>
                        <th scope="col" class="fw-bolder">Delivery Date</th>
                        <th scope="col" class="fw-bolder">Status</th>
                        <th scope="col" class="fw-bolder">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td> <?= $order['Order'] ?></td>
                        <td> <?= $order['order_item_id'] ?></td>
                        <td> 
                            <a href="<?= base_url() ?>/products/<?= $order['product_inventory_id'] ?>">
                                <?= $order['product'] ?>
                            </a>
                        </td>
                        <td> 
                            <a href="<?= base_url() ?>/chat/<?= $order['customer_id'] ?>">
                                <?= $order['name'] . ' ' . $order['surname'] ?>
                            </a>
                        </td>

                        <td> <?= date("jS M Y",strtotime($order['order_date'])) ?> </td>
                        <td>
                            <?php echo ( $order['delivery_date'] == NULL ? '-' : date("jS M Y",strtotime($order['delivery_date'])) ); ?>
                        </td>
                        <td> <?= $order['order_status'] ?></td>
                        <td class="">
                            <?php if($order['order_status'] == "Ordered") : ?>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <button class="btn btn-danger border-danger mb-2"   onclick="cancelOrder(<?= $order['order_item_id'] ?>)">Cancel</button>
                                        <button class="btn btn-success border-success mb-2" onclick="completeOrder(<?= $order['order_item_id'] ?>)">Complete</button>
                                    </div>
                                </div>
                                
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
</div>

<?= $this->endSection()?>
<?= $this->section("scripts") ?>
    <script src="/assets/js/ajax/orderActions.js"></script>
<?= $this->endSection()?>