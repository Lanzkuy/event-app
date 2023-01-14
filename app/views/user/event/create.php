
<form action="./store" method="post" enctype="multipart/form-data">
    <select name="category_id">
        <option value="0">select category</option>
        <?php foreach($data['categories'] as $data){ ?>
            <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
        <?php } ?>
    </select><br>
    <input type="text" name="title" placeholder="title"><br>
    <input type="text" name="description" placeholder="description"><br>
    <input type="file" name="image" placeholder="image"><br>
    <input type="text" name="location" placeholder="location"><br>
    <input type="datetime-local" name="start_datetime" placeholder="start_datetime"><br>
    <input type="datetime-local" name="end_datetime" placeholder="end_datetime"><br>

    <input type="submit" value="Create">
</form>
<a href="../event">back</a>