<a href="home">home</a><br>
<?php if($data['order']){ ?>
<table>
    <tr>
        <th>event_title</th>
        <th>ticket_type</th>
        <th>ticket_price</th>
        <th>ticket_qty</th>
        <th>total</th>
        <th>status</th>
        <th>action</th>
    </tr>
        <?php foreach($data['orderDetails'] as $orderDetail){?>
            <tr>
                <td><?= $orderDetail['event_title'] ?></td>
                <td><?= $orderDetail['ticket_type'] ?></td>
                <td>Rp<?= number_format($orderDetail['ticket_price'])?></td>
                <td><?= $orderDetail['qty']?></td>
                <td>Rp<?= number_format($orderDetail['total_price'])?></td>
                <td><?= $data['order']['status'] ?></td>
                <td>
                    <form action="./cart/delete" method="post">
                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                        <input type="hidden" name="orderDetail_id" value="<?= $orderDetail['id'] ?>">
                        <button type="submit">delete</button>
                    </form>
                </td>
            </tr>

        <?php } ?>
</table>
<br>
<table>
    <tr>
        <th>total_price</th>
    </tr>
    <tr>
        <td>Rp<?= number_format($data['order']['total_price']) ?></td>
    </tr>
</table>
<br>
<form action="./cart/checkout" method="post">
    <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
    <button type="submit">checkout</button>
</form>
<?php } else { ?>
    no order
<?php } ?>