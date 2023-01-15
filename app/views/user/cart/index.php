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
            <div class="col-9">
                <h2>Cart</h2>
            </div>
        </div>
        <hr>
        <?php if($data['order']){ ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Ticket type</th>
                        <th>Ticket price</th>
                        <th>Ticket qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['orderDetails'] as $orderDetail){?>
                        <tr>
                            <td>
                                <img src="./assets/img/events/<?=$orderDetail['event_image']?>" alt="" width="150" height="100"><br><br>
                                <?= $orderDetail['event_title'] ?>
                            </td>
                            <td><?= $orderDetail['ticket_type'] ?></td>
                            <td>Rp<?= number_format($orderDetail['ticket_price'])?></td>
                            <td><?= $orderDetail['qty']?></td>
                            <td>Rp<?= number_format($orderDetail['total_price'])?></td>
                            <td><?= $data['order']['status'] ?></td>
                            <td>
                                <form action="./cart/delete" method="post">
                                    <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                                    <input type="hidden" name="orderDetail_id" value="<?= $orderDetail['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="text-center">
                            <td colspan="7" align="right">Total Price : <b>Rp<?= number_format($data['order']['total_price']) ?></b></td>
                            <tr>
                                <td colspan="7" align="right">
                                    <form action="./cart/checkout" method="post">
                                        <input type="hidden" name="order_id" value="<?= $data['order']['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-success">checkout</button>
                                    </form>
                                </td>
                                 
                            </tr>
                        </tr>
                </tbody>
            </table>
        <?php }else {?>
            <div class="text-center">
                no order
            </div>
        <?php } ?>
    </div>
</div>   
