<input type="hidden" name="id" class="form-control" value="<?= $data['editData']->id; ?>">
<input type="hidden" name="image_current" class="form-control" value="<?= $data['editData']->image; ?>">
<label>User</label>
<select class="form-select mb-3" name="user_id" value="<?= $data['editData']->user_id; ?>">
    <?php foreach ($data['userData'] as $user) { ?>
        <option <?php if ($data['editData']->user_id == $user['id']) {
                    echo "selected";
                } ?> value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
    <?php } ?>
</select>
<label>Category</label>
<select class="form-select mb-3" name="category_id" value="<?= $data['editData']->category_id; ?>">
    <?php foreach ($data['categoryData'] as $category) { ?>
        <option <?php if ($data['editData']->category_id == $category['id']) {
                    echo "selected";
                } ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
    <?php } ?>
</select>
<label>Title</label>
<div class="form-group">
    <input type="text" name="title" class="form-control" value="<?= $data['editData']->title; ?>">
</div>
<label>Description</label>
<div class="form-group">
    <input type="text" name="description" class="form-control" value="<?= $data['editData']->description; ?>">
</div>
<label>Image</label>
<div class="form-group">
    <img src="<?= BASE_URL ?>/assets/images/<?= $data['editData']->image; ?>" alt="event image" width="100" height="100">
    <input type="file" name="image" class="form-control mt-1">
</div>
<label>Location</label>
<div class="form-group">
    <input type="text" name="location" class="form-control" value="<?= $data['editData']->location; ?>">
</div>
<label>Start Datetime</label>
<div class="form-group mb-3">
    <input type="datetime-local" name="start_datetime" class="form-control" value="<?= $data['editData']->start_datetime; ?>">
</div>
<label>End Datetime</label>
<div class="form-group">
    <input type="datetime-local" name="end_datetime" class="form-control" value="<?= $data['editData']->end_datetime; ?>">
</div>