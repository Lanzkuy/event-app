<div id="app ">
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand text-white" href="">
                E-Event
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>/userevent">My Event (<?= $data['eventCount'] ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./cart">Cart (<?= $data['orderDetailCount'] ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./history">History (<?= $data['orderDetailCount2'] ?>)</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?= $_SESSION['user_session']['name'] ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= BASE_URL ?>/dashboard/logout">
                                Logout
                            </a>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="main mt-4">
    <div class="container">
        <div class="row">
            <div class="text-center fs-1">
                Welcome to E-Event
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php Flasher::flash(); ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-9">
                <h2>Latest Event</h2>
            </div>
            <div class="col-3">
                <form method="GET">
                    <div class="input-group mb-3 rounded-4">
                        <input type="search" class="form-control" name="search" placeholder="Search event by title...">
                    </div>
                </form>
            </div>

            <div class="row mt-4">
                <?php if ($data['events']) { ?>
                    <?php foreach ($data['events'] as $event) { ?>
                        <div class="col-4 mt-4">
                            <div class="card rounded-4">
                                <div class="card-body">
                                    <img src="./assets/images/events/<?= $event['image'] ?>" alt="" class="img-fluid rounded-4" loading="lazy">
                                    <div class="row mt-2">
                                        <h5><b><?= $event['title'] ?><br></b></h5>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-sm btn-primary rounded-4" type="button" href="./userhome/detail?id=<?= $event['id'] ?>">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text-center">
                        No Event
                    </div>
                <?php } ?>
            </div>
            <nav aria-label="...">
                <ul class="pagination pagination-lg">
                    <?php for ($i = 1; $i <= $data['numberOfPages']; $i++) {
                        if ($i != $data['page']) {
                            if (isset($_GET['search'])) {
                                $search = $data['search'];
                                echo "<li class='page-item'><a class='page-link' href='./userhome?page=$i&search=$search'>$i</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='./userhome?page=$i'>$i</a></li>";
                            }
                        } else {
                            echo "<li class='page-item active' aria-current='page'>
                    <span class='page-link'>$i</span>
                    </li>";
                        }
                    }
                    ?>
                </ul>
            </nav>

        </div>
    </div>
</div>