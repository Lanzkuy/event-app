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
                <h2>Edit Event</h2><a href="../userevent"> Back</a>
            </div>
        </div>
        <hr>
        <form enctype="multipart/form-data" method="post" action="./updateEvent">
            <input type="hidden" value="<?= $data['event']['id'] ?>" name="id">
            <input type="hidden" value="<?= $data['event']['image'] ?>" name="image_current">
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-4">
                        <img src="../assets/img/events/<?=$data['event']['image'] ?>" class="img-fluid rounded-4 img-thumbnail" id="preview_img" alt="preview_img">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <table class="table" style="border-top : hidden">
                                <tr>
                                    <td>Category</td>
                                    <td>:</td>
                                    <td>
                                        <select name="category_id" class="rounded-3 form-control form-select">
                                            <option value="0" selected>--- Select Category ---</option>
                                            <?php foreach($data['categories'] as $category){ ?>
                                                <option class="form-control" value="<?= $category['id'] ?>" <?= $data['event']['category_id'] == $category['id'] ? "selected" : "" ?>><?= $category['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['event']['title'] ?>" type="text" name="title" placeholder="Title" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-floating">
                                            <textarea id="floatingTextarea" name="description" class="rounded-3 form-control" style="height: 100px"><?= $data['event']['description'] ?></textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['event']['location'] ?>" type="text" name="location" placeholder="Location" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date Time</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['event']['start_datetime'] ?>" type="datetime-local" name="start_datetime" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date Time</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['event']['end_datetime'] ?>" type="datetime-local" name="end_datetime" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" accept="image/*" class="rounded-3 form-control" name="image" onchange="loadFile(event)">
                                    </td>
                                </tr>
                                <script>
                                    let loadFile = function(event){
                                        let output = document.getElementById('preview_img');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script>
                            </table>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-success rounded-4"> Update Event</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>
            <form enctype="multipart/form-data" method="post" action="./updateTicket">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            <table class="table" style="border-top : hidden">
                                <tr>
                                    <td>Reguler Ticket</td>
                                    <td>:</td>
                                </tr>
                                <input type="hidden" name="reguler_id" value="<?= $data['ticketReguler']['id'] ?>">
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['ticketReguler']['description'] ?>" type="text" name="reguler_description" placeholder="Reguler ticket description" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['ticketReguler']['stock'] ?>" type="number" name="reguler_stock" placeholder="Reguler ticket stock" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?= $data['ticketReguler']['price'] ?>" type="number" name="reguler_price" placeholder="Reguler ticket price" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>VIP Ticket</td>
                                    <td>:</td>
                                </tr>
                                <input type="hidden" name="vip_id" value="<?= $data['ticketVIP']['id'] ?>">
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" value="<?= $data['ticketVIP']['description'] ?>" name="vip_description" placeholder="VIP ticket description" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" value="<?= $data['ticketVIP']['stock'] ?>" name="vip_stock" placeholder="VIP ticket stock" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" name="vip_price" value="<?= $data['ticketVIP']['price'] ?>" placeholder="VIP ticket price" class="form-control">
                                    </td>
                                </tr>

                            </table>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-success rounded-4"> Update Ticket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>
       
    </div>
</div>   