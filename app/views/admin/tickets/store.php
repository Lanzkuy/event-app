<label>Event</label>
<select class="form-select mb-3" name="event_id">
    <?php foreach ($data['eventData'] as $event) { ?>
        <option value="<?= $event['id']?>"><?= $event['title']?></option>
    <?php } ?>
</select>
<label>Price</label>
<div class="form-group">
    <input type="number" name="price" class="form-control" value="0">
</div>
<label>Stock</label>
<div class="form-group">
    <input type="number" name="stock" class="form-control" value="0">
</div>
<label>Type</label>
<select class="form-select mb-3" name="type">
    <option value="Reguler">Reguler</option>
    <option value="VIP">VIP</option>
</select>
<label>Description</label>
<div class="form-group">
    <input type="text" name="description" class="form-control">
</div>