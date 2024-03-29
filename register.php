<?php
ob_start();
$website_title = 'Register';
include 'includes/init.php';
include 'includes/templates/head.php';
LoggedInRedirect();
RegisterRedirect();
$error_msg = '';
$hide_box = '';
$show_box = "display:none;";

if (!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = clean_data($_POST['username']);
    $email = clean_data($_POST['email']);
    $password = clean_data($_POST['password']);
    $activationKey = base64_encode(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if(checkUsernameAlreadyExists($username) == true){
        $error_msg .= '<p>This username is already in use.</p>';
    }

    if(checkEmailAlreadyExists($email) == true) {
        $error_msg .= '<p>This email is already in use.</p>';
    }
     
    if(checkUsernameAlreadyExists($username) == false && checkEmailAlreadyExists($email) == false) {
        registerUser($_POST, $activationKey);
        sendRegistrationEmail($username, $email, $activationKey);
        $hide_box = "style='display:none;'";
        $show_box = "display:inline-block;";
    }
}

?>

<div class="mainContent register_container container">
    <div class="row">
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <h3>Register</h3>
            <b style="color: red;"><?php echo $error_msg; ?></b>
            <p>To register, please fill in the below form.</p>
            <form action="register.php" method="POST" <?php echo $hide_box; ?>>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Register</button>
            <a class="btn btn-outline-secondary" href="login.php">Cancel</a>
            </form>
            <b style="color: green; <?php echo $show_box; ?>">You have been emailed, please activate your account.<br><a href="login.php">Click Here to Login</a></b>
        </div>
    </div>

</div>