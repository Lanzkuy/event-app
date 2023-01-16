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
                <h2>Add Event</h2><a href="../userevent"> Back</a>
            </div>
        </div>
        <hr>
        <form enctype="multipart/form-data" method="post" action="./store">
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-4">
                        <img class="img-fluid rounded-4 img-thumbnail" id="preview_img" alt="Preview Image">
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
                                            <?php foreach($data['categories'] as $data){ ?>
                                                <option value="<?= $data['id'] ?>" required><?= $data['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" required name="title" placeholder="Title" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-floating">
                                            <textarea required id="floatingTextarea" name="description" class="rounded-3 form-control" style="height: 100px"></textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" required name="location" placeholder="Location" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date Time</td>
                                    <td>:</td>
                                    <td>
                                        <input type="datetime-local" required name="start_datetime" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date Time</td>
                                    <td>:</td>
                                    <td>
                                        <input type="datetime-local" required name="end_datetime" class="rounded-3 form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" accept="image/*" required class="rounded-3 form-control" name="image" onchange="loadFile(event)">
                                    </td>
                                </tr>
                                <script>
                                    let loadFile = function(event){
                                        let output = document.getElementById('preview_img');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script>
                                <tr>
                                    <td>Reguler Ticket</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" required name="reguler_description" placeholder="Reguler ticket description" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" required min="1" name="reguler_stock" placeholder="Reguler ticket stock" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" required min="0" name="reguler_price" placeholder="Reguler ticket price" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>VIP Ticket</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" required name="vip_description" placeholder="VIP ticket description" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" required min="1" name="vip_stock" placeholder="VIP ticket stock" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>
                                        <input type="number" required min="0" name="vip_price" placeholder="VIP ticket price" class="form-control">
                                    </td>
                                </tr>


                            </table>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-success rounded-4"> Add Event</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>

    </div>
</div>   