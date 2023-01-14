<a href="../">back</a><br><br>

<?= $data['event']['category_name']  ?><br>
<hr>
<?= $data['event']['user_name']  ?><br>
<?= $data['event']['user_email']  ?><br>
<hr>
<?= $data['event']['id']  ?><br>
<?= $data['event']['title'] ?><br>
<?= $data['event']['description']  ?><br>
<img src="../assets/img/events/<?= $data['event']['image'] ?>" width="100" height="100"><br>
<?= $data['event']['location']  ?><br>
<?= $data['event']['start_datetime']  ?><br>
<?= $data['event']['end_datetime']  ?><br>
<hr>
<?php foreach($data['tickets'] as $ticket){?>
    <?= $ticket['type'] ?><br>
    <?= $ticket['description'] ?><br>
    <?= $ticket['stock'] ?><br>
    Rp<?= number_format($ticket['price']) ?><br>
    <form action="../order/insert" method="post">
        <input type="hidden" name="event_id" value="<?= $data['event']['id']?>">
        <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
        <input type="hidden" name="ticket_price" value="<?= $ticket['price'] ?>">
        <input type="hidden" name="ticket_stock" value="<?= $ticket['stock'] ?>">
        <input type="number" placeholder="amount" name="ticket_amount">
        <button type="submit">insert to cart</button>
    </form>
    <hr>
<?php } ?>


