<?= $this->extend('/layouts/main') ?>

<?= $this->section('title') ?> Chat <?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container-fluid my-0 my-md-5 my-lg-5 my-xl-5 px-0 px-md-5 px-lg-5 px-xl-5 h-75 pb-0 pb-md-5 pb-lg-5 pb-xl-5">
    <div class="d-flex flex-column align-items-center justify-content-center mb-4">
        <p class="fs-4 fw-bolder">Chat</p>
    </div>
    <div class="container-md h-100 shadow-md-lg border border-1 rounded">
        
        <div class="row h-100">
            <!-- User List -->
            <div class="col-12 col-md-4 px-0 h-100 overflow-auto border rounded border-1">
                <div class="list-group overflow-auto">
                    <?php foreach ($chats as $person) :?>
                        <?php if ($customer): ?>
                            <a href="<?= base_url() ?>/chat/<?= $person['seller_id']?>" class="list-group-item list-group-item-action py-4">
                        <?php else : ?>            
                            <a href="<?= base_url() ?>/chat/<?= $person['customer_id']?>" class="list-group-item list-group-item-action py-4">
                        <?php endif; ?>
                        <?php 
                            if ($customer)
                                    echo ($person['seller']);
                            else 
                                echo ($person['customerName'] . ' ' . $person['customerSurname']);
                        ?>
                    </a>
                    <?php endforeach; ?>
                </div>

            </div>
            <!-- Chat messages -->
            <div class="col-12 col-md-8 px-0 h-100 overflow-auto" id="messages">
                <?php if ($chat_id != NULL):  ?>
                <div class="container-fluid d-flex flex-column">
                    <div class="d-flex flex-column justify-content-end py-1">
                        <?php foreach($chat as $message) : ?>
                            <?php if (($message['userMSG'] == 1 && $customer) || ($message['userMSG'] == 0 && !$customer)) : ?>
                                <div><p class="float-end px-2 py-1 mb-2 border rounded" style="max-width: 75%;"><?= $message['msg'] ?></p></div>
                            <?php else : ?>
                                <div><p class="float-start px-2 py-1 mb-2 border rounded" style="max-width: 75%;"><?= $message['msg'] ?></p></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="flex-shrink-1 px-2 py-2">
                        <div class="row px-0">
                            <div class="col-8 pe-0 mr-2">
                                <input type="text" class="customInput  py-2" placeholder="Message"
                                    id="message">
                            </div>
                            <div class="col-4 ps-0 ml-1">
                                <button class="customButton py-2 btn-outline-success  fw-bolder border-success" onclick="sendMessage(<?=$chat_id?>,  <?=$chatting_to?>)">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section('scripts') ?>
<script src="/assets/js/ajax/chat.js"></script>
<?= $this->endSection() ?>