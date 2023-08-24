<?php
    echo $this->include('Modules\Master\Views\header_login');
    $theme = session()->get('themevalue');
?>

<section class="loginForm">
    <div class="container"> 
        <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10 d-flex align-items-center min-vh-100  py-4">
            <div class="wrap row">
            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last col-md-6 bg-primary-gradient text-white">
                <div class="text w-100">
                <div class="text-center mb-4">
                    <img src="<?php echo base_url() ?>/admin/assets/img/logo-white.png" class="logo">
                </div>
                <h5>Welcome   Onest Shooled 1</h5>
                <p>Wonderful environment where children undertakes laborious physical learn and grow. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sin 1.</p>
                
                </div>
            </div>
            <div class="login-wrap p-4 p-lg-5 col-md-6">
                <div class="d-flex">
                <div class="w-100">
                    <h3 class="mb-4">Sign In</h3>
                </div> 
                </div>
                <?php

                    if(isset($error)){
                        //echo $error;
                        echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                    }
                    ?>
                    <?php
                    if(session()->getFlashdata('success')){
                        echo "<h4 style='color:green;text-align:center;'>".session()->getFlashdata('success')."</h4>";
                    }
                ?>

                <form class="signin-form"  action="<?php echo base_url() ?>login" method="post">
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Username</label>
                    <input type="text" class="form-control"  name="email" id="email" placeholder="Enter username"
                    value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                    <small style="color:red;" class="text-danger"><?php if (isset($validation)) {
                        echo $validation->getError('email');
                    } ?>
                    </small>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="<?php if (isset($rememberkey)) {
                        echo $rememberkey;
                    } ?>">
                    <small style="color:red;" class="text-danger"><?php if (isset($validation)) {
                        echo $validation->getError('password');
                    } ?>
                    </small>
                </div>
                <div class="form-group mt-4 mb-3">
                    <button type="submit" class="btn btn-primary rounded-pill w-100 px-3">Sign In</button>
                </div>
                <div class="form-group d-md-flex">
                    <div class="w-50 text-left">
                    <label class="checkbox-wrap checkbox-primary mb-0">
                        <input type="checkbox"  id="customControlInline" name="remember"> Remember Me 
                        <span class="checkmark" for="customControlInline"></span>
                    </label>
                    </div>
                    <div class="w-50 text-md-end">
                    <a href="<?=base_url('/forgot_pass');?>">Forgot Password</a>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
       <div class="text-center">
       <p class="">© <script> document.write(new Date().getFullYear())</script> Rs smart wealth. Crafted with <i class="mdi mdi-heart text-danger"></i> by <b>RS Software</b></p>
       </div>
    </div>
</section>


                            






</body>

</html>