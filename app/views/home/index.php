welcome, <?= $_SESSION['user_session']['name'] ?><br>

<form action="./home/logout" method="post">
    <input type="submit" value="Logout">
</form>

<a href="./event">list events (<?= $data['eventCount'] ?>)</a><br>
<a href="./cart">cart (<?= $data['orderDetailCount'] ?>)</a><br>
<a href="./history">history (<?= $data['orderDetailCount2'] ?>)</a><br>

<form method="get">
    <input type="text" name="search" placeholder="search event by name">
    <button type="submit">search</button>
</form>

<?php foreach($data['events'] as $event){ ?>
    <hr>
    <?= $event['id'] ?><br>
    <?= $event['title'] ?><br>
    <?= $event['description'] ?><br>
    <img src="./assets/img/events/<?=$event['image']?>" width="100" height="100"><br>
    <?= $event['location'] ?><br>
    <?= $event['start_datetime'] ?><br>
    <?= $event['end_datetime'] ?><br><br>
    <?= $event['category_name'] ?><br><br>
    <?= $event['user_name'] ?><br>
    <?= $event['user_email']?><br><br>

    <a href="./home/detail?id=<?=$event['id'] ?>">detail</a>

    <hr>
<?php } ?>

<?php for ($i=1; $i <= $data['numberOfPages']; $i++) { 
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
