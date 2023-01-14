<label>User</label>
<select class="form-select mb-3" name="user_id">
    <?php foreach ($data['userData'] as $user) { ?>
        <option value="<?= $user['id']?>"><?= $user['name']?></option>
    <?php } ?>
</select>
<label>Category</label>
<select class="form-select mb-3" name="category_id">
    <?php foreach ($data['categoryData'] as $category) { ?>
        <option value="<?= $category['id']?>"><?= $category['name']?></option>
    <?php } ?>
</select>
<label>Title</label>
<div class="form-group">
    <input type="text" name="title" class="form-control">
</div>
<label>Description</label>
<div class="form-group">
    <input type="text" name="description" class="form-control">
</div>
<label>Image</label>
<div class="form-group">
    <input type="file" name="image" class="form-control">
</div>
<label>Location</label>
<div class="form-group">
    <input type="text" name="location" class="form-control">
</div>
<label>Start Datetime</label>
<div class="form-group mb-3">
    <input type="datetime-local" name="start_datetime" class="form-control">
</div>
<label>End Datetime</label>
<div class="form-group">
    <input type="datetime-local" name="end_datetime" class="form-control">
</div>