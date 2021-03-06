<?php
session_start();
include('config/config.php');
if (isset($_POST['login'])) {
    $login_user_email = $_POST['login_user_email'];
    $login_user_password = sha1(md5($_POST['login_user_password']));
    $login_user_permission = $_POST['login_user_permission'];

    $stmt = $conn->prepare("SELECT login_user_email, login_user_password, login_id, login_user_permission FROM liteERP_Login WHERE login_user_email =? AND login_user_password =? AND login_user_permission =? ");
    $stmt->bind_param('sss', $login_user_email, $login_user_password, $login_user_permission);

    $stmt->execute();
    $stmt->bind_result($login_user_email, $login_user_password, $login_id, $login_user_permission);
    $rs = $stmt->fetch();

    $_SESSION['login_user_email'] = $login_user_email;

    if ($rs && $login_user_permission == '1') {
        header("location:dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php require_once("partials/head.php"); ?>
<!-- ./Head -->

<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">liteERP - SuperUser Sign In</h1>
                        <p class="">Please provide your authentication credentials</p>
                        <form method="post" class="text-left">
                            <div class="form" method="post">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="login_user_email" type="email" required class="form-control">
                                    <input id="username" style="display:none" value="1" name="login_user_permission" type="text" class="form-control">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a target="_blank" href="reset_pwd.php" class="forgot-pass-link">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="login_user_password" required type="password" class="form-control">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <input type="submit" class="btn btn-primary" name="login" value="Log In">
                                    </div>
                                </div>

                                <div class="division">
                                    <span>OR</span>
                                </div>
                                <a href="javascript:void(0);" class="btn social-fb text-justify">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>
                                    <span class="brand-name">Login In As Staff</span>
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('partials/scripts.php'); ?>
</body>

</html>