<?php
ob_start();
imagejpeg($data['captcha']);
$rawImageBytes = ob_get_clean();
?>
<div class="row">
    <div class="col-lg-12">
        <?php Flasher::flash(); ?>
    </div>
</div>
<form action="<?= BASE_URL ?>/login/auth" method="post">
    <input type="text" placeholder="Email" name="email"><br>
    <input type="password" placeholder="Password" name="password"><br>
    <label class="mt-2">Please show you're not a robot?</label>
    <?php echo "<img src='data:image/jpeg;base64," . base64_encode($rawImageBytes) . "' />"; ?>
    <input type="text" name="captcha" placeholder="Input captcha here" maxlength="5">
    <input type="submit" value="Login">
    <a href="register">Register</a>
</form>