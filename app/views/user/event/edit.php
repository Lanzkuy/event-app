<form action="./updateEvent" method="post" enctype="multipart/form-data">
    <select name="category_id">
        <option value="0">select category</option>
        <?php foreach($data['categories'] as $category){ ?>
            <option value="<?= $category['id'] ?>" <?= $data['event']['category_id'] == $category['id'] ? "selected" : "" ?>><?= $category['name'] ?></option>
        <?php } ?>
    </select><br>
    <input type="hidden" value="<?= $data['event']['id'] ?>" name="id">
    <input type="hidden" value="<?= $data['event']['image'] ?>" name="image_current">
    <input type="text" name="title" placeholder="title" value="<?= $data['event']['title'] ?>"><br>
    <input type="text" name="description" placeholder="description" value="<?= $data['event']['description'] ?>"><br>
    <img src="../assets/img/events/<?=$data['event']['image'] ?>" width="100" height="100"><br>
    <input type="file" name="image"><br>
    <input type="text" name="location" placeholder="location" value="<?= $data['event']['location'] ?>"><br>
    <input type="datetime-local" name="start_datetime" placeholder="start_datetime" value="<?= $data['event']['start_datetime'] ?>"><br>
    <input type="datetime-local" name="end_datetime" placeholder="end_datetime" value="<?= $data['event']['end_datetime'] ?>"><br>
    
    <input type="submit" value="Update Event">
</form>
<hr>
<form action="./updateTicket" method="post">
    <input type="hidden" name="reguler_id" value="<?= $data['ticketReguler']['id'] ?>">
    <input type="text" value="Reguler" disabled><br>
    <input type="number" name="reguler_price" placeholder="price ticket" value="<?= $data['ticketReguler']['price'] ?>"><br>
    <input type="number" name="reguler_stock" placeholder="stock" value="<?= $data['ticketReguler']['stock'] ?>"><br>
    <input type="text" name="reguler_description" placeholder="desc" value="<?= $data['ticketReguler']['description'] ?>"><br><br>
    
    <input type="hidden" name="vip_id" value="<?= $data['ticketVIP']['id'] ?>">
    <input type="text" value="VIP" disabled><br>
    <input type="number" name="vip_price" placeholder="price ticket" value="<?= $data['ticketVIP']['price'] ?>"><br>
    <input type="number" name="vip_stock" placeholder="stock" value="<?= $data['ticketVIP']['stock'] ?>"><br>
    <input type="text" name="vip_description" placeholder="desc" value="<?= $data['ticketVIP']['description'] ?>"><br>
    <br>
    <input type="submit" value="Update Ticket">
</form>

<a href="../event">back</a>