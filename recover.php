<?php
ob_start();
include 'includes/init.php';
include 'includes/templates/head.php';
LoggedInRedirect();
$error_msg = '';
$hide_box = '';
$show_box = "display:none;";

if (!empty($_POST['email']))
{
    $email = clean_data($_POST['email']);
    $recoveryKey = base64_encode(password_hash($_POST['email'], PASSWORD_DEFAULT));

    if(checkEmailAlreadyExists($email) == true) {
        SetRecoveryKey($email, $recoveryKey);
        sendRecoveryEmail($email, $recoveryKey);
        $hide_box = "style='display:none;'";
        $show_box = "display:inline-block;";
    } else {
        $error_msg = 'That email address doesnt exist. Please try again';
    }
}

?>

<div class="mainContent login_container container">
<div class="row">
    <div class="col-md-12 text-center ml-auto mr-auto login_form">
        <h3>Recover Your Account</h3>
        <b style="color: red;"><?php echo $error_msg; ?></b>
        <p>Please enter the email used to register your account.</p>
        <form action="recover.php" method="POST" <?php echo $hide_box; ?>>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Recover Account</button><br><br>
      <a class="btn btn-outline-secondary" href="login.php">Cancel</a>
        </form>
        <b style="color: green; <?php echo $show_box; ?>">Please check your email for instructions</b>
    </div>
</div>
</div>