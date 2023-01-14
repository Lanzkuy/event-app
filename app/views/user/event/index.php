<a href="home">home</a><br>
<a href="./event/create">create event</a>

<form method="get">
    <input type="text" name="search" placeholder="search event by name">
    <button type="submit">search</button>
</form>

<?php foreach($data['events'] as $event){ ?>
    <hr>
    <?= $event['id'] ?><br>
    <?= $event['category_name'] ?><br>
    <?= $event['title'] ?><br>
    <?= $event['description'] ?><br>
    <img src="./assets/img/events/<?=$event['image']?>" width="100" height="100"><br>
    <?= $event['location'] ?><br>
    <?= $event['start_datetime'] ?><br>
    <?= $event['end_datetime'] ?><br>
    <a href="./event/edit?id=<?= $event['id'] ?>">edit event</a><br>
    <a href="./event/delete?id=<?= $event['id'] ?>">delete event</a>
    <hr>
<?php } ?>

<?php for ($i=1; $i <= $data['numberOfPages'] ; $i++) { 
    if($i != $data['page']){
        if(isset($_GET['search'])){
            $search = $data['search'];
            echo "<a href='./event?page=$i&search=$search'>$i</a>";
        }else{
            echo "<a href='./event?page=$i'>$i</a>";
        }
    }else{
        echo "<a href='#'>$i</a>";
    }
}
?>
