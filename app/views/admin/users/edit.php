<input type="hidden" name="id" class="form-control" value="<?= $data['editData']->id; ?>">
<label>Email</label>
<div class="form-group">
    <input type="text" placeholder="Email Address" name="email" class="form-control" value="<?= $data['editData']->email; ?>">
</div>
<label>Name</label>
<div class="form-group">
    <input type="text" placeholder="Name" name="name" class="form-control" value="<?= $data['editData']->name; ?>">
</div>
<label>Role</label>
<select class="form-select" name="role" value="<?= $data['editData']->role; ?>">
    <option <?php if($data['editData']->role == 'admin') { echo "selected"; } ?> value="admin">Admin</option>
    <option <?php if($data['editData']->role == 'user') { echo "selected"; } ?> value="user">User</option>
</select>