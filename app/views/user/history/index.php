<a href="home">home</a><br>

<?php if($data['orderDetail']){ ?>

    <table>
        <tr>
            <th>event_title</th>
            <th>ticket_type</th>
            <th>ticket_price</th>
            <th>ticket_qty</th>
            <th>action</th>
        </tr>
        <?php foreach($data['orderDetail'] as $orderDetails){ ?>
        <?php foreach($orderDetails as $orderDetail){ ?>
            <tr>
                <td><?= $orderDetail['event_title'] ?><br></td>
                <td><?= $orderDetail['ticket_type'] ?><br></td>
                <td><?= $orderDetail['ticket_price']?><br></td>
                <td><?= $orderDetail['qty'] ?><br></td>
                <td><a href="">print ticket</a></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </table>

<?php }else{ ?>
    no data
<?php } ?>

