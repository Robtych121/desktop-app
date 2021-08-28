<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
if (!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = clean_data($_POST['username']);
    $email = clean_data($_POST['email']);
    $password = clean_data($_POST['password']);
    $activationKey = base64_encode(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if(checkUsernameAlreadyExists($username) == true){
        echo '<div class="alert alert-danger text-center" role="alert">This username is already in use.</div>';
        exit();
    }

    if(checkEmailAlreadyExists($email) == true) {
        echo '<div class="alert alert-danger text-center" role="alert">This email is already in use.</div>';
        exit();
    }
     
    if(checkUsernameAlreadyExists($username) == false && checkEmailAlreadyExists($email) == false) {
        registerUser($_POST, $activationKey);
        sendRegistrationEmail($username, $email, $activationKey);
        echo '<div class="alert alert-success text-center" role="alert">User has been created and emailed an activation link</div>';
        exit();
    }
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="form_response_text" class="col-12">

        </div>
    </div>
    <div class="row admin_new_user_con">
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <form id="admin_newuser" action="admin_newuser.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Register</button>
            </form>
        </div>
    </div>
</div>
<script>
$('#admin_newuser').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'admin_newuser.php',
	data: $('#admin_newuser').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">User has been created and emailed an activation link</div>') {
			$('#form_response_text').html(response);
            $('.admin_new_user_con').hide();
            $("#admin_con").load("admin.php", function(responseTxt, statusTxt, xhr){});
		} else {
		$('#form_response_text').html(response);
		}
	}
	});
});

 </script>