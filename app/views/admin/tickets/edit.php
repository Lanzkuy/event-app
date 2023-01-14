<input type="hidden" name="id" class="form-control" value="<?= $data['editData']->id; ?>">
<label>Event</label>
<select class="form-select mb-3" name="event_id">
    <?php foreach ($data['eventData'] as $event) { ?>
        <option <?php if ($data['editData']->event_id == $event['id']) {
                    echo "selected";
                } ?> value="<?= $event['id']?>"><?= $event['title']?></option>
    <?php } ?>
</select>
<label>Price</label>
<div class="form-group">
    <input type="number" name="price" class="form-control" value="<?= $data['editData']->price; ?>">
</div>
<label>Stock</label>
<div class="form-group">
    <input type="number" name="stock" class="form-control" value="<?= $data['editData']->stock; ?>">
</div>
<label>Type</label>
<select class="form-select mb-3" name="type" value="<?= $data['editData']->type; ?>">
    <option <?php if ($data['editData']->type == 'Reguler') {
                echo "selected";
            } ?> value="Reguler">Reguler</option>
    <option <?php if ($data['editData']->type == 'Gold') {
                echo "selected";
            } ?> value="Gold">Gold</option>
    <option <?php if ($data['editData']->type == 'Platinum') {
                echo "selected";
            } ?> value="Platinum">Platinum</option>
    <option <?php if ($data['editData']->type == 'VIP') {
                echo "selected";
            } ?> value="VIP">VIP</option>
    <option <?php if ($data['editData']->type == 'VVIP') {
                echo "selected";
            } ?> value="VVIP">VVIP</option>
</select>
<label>Description</label>
<div class="form-group">
    <input type="text" name="description" class="form-control" value="<?= $data['editData']->description; ?>">
</div>