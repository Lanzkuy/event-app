<a href="home">home</a><br>

<?php if($data['orderDetail']){ ?>

    <?php foreach($data['orderDetail'] as $orderDetails){ ?>
        <?php foreach($orderDetails as $orderDetail){ ?>
            <hr>
            <?= $orderDetail['event_title'] ?><br>
            <?= $orderDetail['ticket_type'] ?><br>
            <?= $orderDetail['ticket_price']?><br>
            <?= $orderDetail['qty'] ?><br>
            <a href="">print ticket</a>
            <hr>
        <?php } ?>
    <?php } ?>

<?php }else{ ?>
    no data
<?php } ?>

