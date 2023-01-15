<div id="app ">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="logo ">
                        <a href="<?= BASE_URL ?>/dashboard/admin">
                            <h3 class="text-primary">Event App</h3>
                        </a>
                    </div>
                    <div class="me-0" id="toggle-dark"></div>
                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-x l-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/admin" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/admin/user/change-password" class='sidebar-link'>
                            <i class="bi bi-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/logout" class='sidebar-link'>
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Data Management</li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/admin/user" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/admin/event" class='sidebar-link'>
                            <i class="bi bi-calendar-event-fill"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="<?= BASE_URL ?>/dashboard/admin/ticket" class='sidebar-link'>
                            <i class="bi bi-ticket-fill"></i>
                            <span>Tickets</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/dashboard/admin/order" class='sidebar-link'>
                            <i class="bi bi-receipt"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Ticket</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/dashboard/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ticket</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div class="card-header">Ticket Data</div>
                    <button class="btn btn-primary m-4 px-4" onclick="openModal(0, 'Ticket')" data-bs-toggle="modal" data-bs-target="#ticketModal">Add</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="adminTable">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['ticketData'] as $ticket) { ?>
                                <tr>
                                    <td><?= $ticket['event_title']; ?></td>
                                    <td><?= $ticket['price']; ?></td>
                                    <td><?= $ticket['stock']; ?></td>
                                    <td><?= $ticket['type']; ?></td>
                                    <td><?= $ticket['description']; ?></td>
                                    <td>
                                        <i class="badge-circle font-medium-1" data-feather="edit" onclick="openModal(<?= $ticket['id']; ?>, 'Ticket')" data-bs-toggle="modal" data-bs-target="#ticketModal"></i>
                                        <a href="<?= BASE_URL ?>/dashboard/admin/ticket/delete/<?= $ticket['id']; ?>" onClick="javascript: return confirm('Are you sure want to delete ?');">
                                            <i class="badge-circle font-medium-1" data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalTitle">Add Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id, page) {
        if (id === 0) {
            $('.modal-title').html('Add ' + page)
            let url = '<?= BASE_URL ?>/dashboard/admin/' + page.toLowerCase() + '/store';

            $.post(url, function(data, success) {
                $('form').get(0).setAttribute('action', page.toLowerCase() + '/store');
                $('.modal-body').html(data);
            })
        } else {
            $('.modal-title').html('Edit ' + page)
            let url = '<?= BASE_URL ?>/dashboard/admin/' + page.toLowerCase() + '/edit/' + id;

            $.post(url, function(data, success) {
                $('form').get(0).setAttribute('action', page.toLowerCase() + '/update/' + id);
                $('.modal-body').html(data);
            })
        }
    }
</script>