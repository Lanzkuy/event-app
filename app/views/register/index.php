<div class="container h-100">
    <div class="d-flex align-items-center justify-content-center row h-100">
        <div class="login col-8">
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <h1>Sign Up</h1>
            <p class="mb-5">
                Welcome, please enter your credentials
            </p>

            <form action="<?= BASE_URL ?>/register/auth" method="POST">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Email" name="email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Name" name="name">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-key"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="confirm_password">
                    <div class="form-control-icon">
                        <i class="bi bi-key"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">
                    Sign Up
                </button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">
                    Have and account already?
                    <a href="login" class="font-bold">Sign In</a>.
                </p>
            </div>
        </div>
    </div>
</div>