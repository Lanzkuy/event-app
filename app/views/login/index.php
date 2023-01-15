<?php
ob_start();
imagejpeg($data['captcha']);
$rawImageBytes = ob_get_clean();
?>
<div class="container h-100">
    <div class="d-flex align-items-center justify-content-center row h-100">
        <div class="login col-8">
            <div class="row">
                <div class="col-lg-12">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <h1>Log in.</h1>
            <p class="mb-5">
                Welcome, please enter your credentials
            </p>

            <form action="<?= BASE_URL ?>/login/auth" method="POST">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Email" name="email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-key"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <?php echo "<img alt='captcha' class='mb-4 rounded' src='data:image/jpeg;base64," . base64_encode($rawImageBytes) . "' />"; ?>
                    <div class="form-group position-relative ms-4 mb-4 col-10">
                        <input type="text" class="form-control form-control-xl" placeholder="Enter captcha here" name="captcha">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">
                    Log in
                </button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="register" class="font-bold">Sign up</a>.
                </p>
            </div>
        </div>
    </div>
</div>