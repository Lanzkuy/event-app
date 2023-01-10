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
                    <li class="sidebar-item active">
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
                    <li class="sidebar-item">
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
                        <h3>User</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/dashboard/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">

        </div>
    </div>
</div>