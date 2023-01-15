<div id="app ">
    <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand text-white" href="<?= BASE_URL ?>/dashboard">
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
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?= $_SESSION['user_session']['name']?>
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
            <div class="col-6">
                <div class="card">
                        <img src="../assets/img/events/<?= $data['event']['image'] ?>" alt="" class="img-fluid rounded-4 img-thumbnail" loading="lazy">
                </div>
            </div>
            <div class="col-6">
                <h2>
                    <b><?= $data['event']['title'] ?></b>
                </h2>
                <p class="mt-4">
                    Category:<br>
                    <?= $data['event']['category_name']  ?><br>
                </p>
                <p class="mt-4">
                    Description:<br>
                    <?= $data['event']['description']  ?><br>
                </p>
                <p class="mt-4">
                    Location: <br>
                    <?= $data['event']['location']  ?><br>
                </p>
                <div class="row mt-4">
                    <div class="col-5">
                        Start Date:<br>
                        <?= $data['event']['start_datetime']  ?><br>
                    </div>
                    <div class="col-2">
                        |
                    </div>
                    <div class="col-5">
                        End Date:<br>
                        <?= $data['event']['end_datetime']  ?><br>
                    </div>
                </div>
                <hr>
                    <?php foreach($data['tickets'] as $ticket){?>
                        <form action="../order/insert" method="post">
                            <div class="card">
                                <div class="card-body">
                                    <?= $ticket['type'] ?> | Price: Rp<?= number_format($ticket['price']) ?> | Stock: <?= $ticket['stock'] ?>
                                    <hr>
                                    <?= $ticket['description'] ?>
                                    <hr>
                                    <input type="hidden" name="event_id" value="<?= $data['event']['id']?>">
                                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                    <input type="hidden" name="ticket_price" value="<?= $ticket['price'] ?>">
                                    <input type="hidden" name="ticket_stock" value="<?= $ticket['stock'] ?>">
                                    <?php if($ticket['stock'] != 0){ ?>
                                    <input type="number" class="form-control" placeholder="amount you want order" name="ticket_amount" required min="1" max="<?= $ticket['stock']?>">
                                    <div class="d-grid gap-2 mt-2">
                                        <button class="btn btn-primary rounded-4" type="submit">Insert to cart</button>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    <?php } ?>  
            </div>
        </div>
    </div>
    
</div>


