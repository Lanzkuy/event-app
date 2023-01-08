<form action="./update" method="post" enctype="multipart/form-data">
    <select name="category_id">
        <option value="0">select category</option>
        <?php foreach($data['categories'] as $category){ ?>
            <option value="<?= $category['id'] ?>" <?= $data['category']['id'] == $category['id'] ? "selected" : "" ?>><?= $category['name'] ?></option>
        <?php } ?>
    </select><br>
    <input type="hidden" value="<?= $data['event']['id'] ?>" name="id">
    <input type="hidden" value="<?= $data['event']['image'] ?>" name="image_current">
    <input type="text" name="title" placeholder="title" value="<?= $data['event']['title'] ?>"><br>
    <input type="text" name="description" placeholder="description" value="<?= $data['event']['description'] ?>"><br>
    <img src="../assets/img/<?=$data['event']['image']?>" width="100" height="100"><br>
    <input type="file" name="image"><br>
    <input type="text" name="location" placeholder="location" value="<?= $data['event']['location'] ?>"><br>
    <input type="datetime-local" name="start_datetime" placeholder="start_datetime" value="<?= $data['event']['start_datetime'] ?>"><br>
    <input type="datetime-local" name="end_datetime" placeholder="end_datetime" value="<?= $data['event']['end_datetime'] ?>"><br>
    
    <input type="submit" value="Update">
</form>
<a href="../event">back</a>