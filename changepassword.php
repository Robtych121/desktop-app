<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();

if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['password_confirm'])){

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $password_confirm = $_POST['password_confirm'];

    $username = getUsernameDetail($_SESSION['user_id']);

    if(password_verify($old_password, checkUserPassword($username))) {
        if($new_password == $password_confirm){
			changePassword($_SESSION['user_id'], $password_confirm);
			echo '<b style="color:green;">Password Updated Correctly</b>';
			exit();
        } else {
			echo '<b style="color:red;">Your new passwords do not match</b>';
			exit(); 
        }
        
    } else {
		echo '<b style="color:red;">Incorrect old password</b>';
		exit();
	}
}
?>

<div class="mainContent container text-center">
<div class="row">
	<div id="form_response_text" class="col-12">

	</div>
</div>
<div class="row change_pw_container">
	<div class="col-12">
		<form id="changepassword" action="changepassword.php" method="POST">
		<div class="form-group">
			<label for="password">Old Password</label>
			<input type="password" class="form-control" id="old_password" name="old_password" required autocomplete="nope">
		</div>
		<div class="form-group">
			<label for="password">New Password</label>
			<input type="password" class="form-control" id="new_password" name="new_password" required autocomplete="nope">
		</div>
		<div class="form-group">
			<label for="password_confirm">Confirm New Password</label>
			<input type="password" class="form-control" id="password_confirm" name="password_confirm" required autocomplete="nope">
		</div>
		<button type="submit" class="btn btn-secondary">Change Password</button>
		</form>
	</div>
</div>
</div>

<script>
$('#changepassword').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'changepassword.php',
	data: $('#changepassword').serialize(),
	success: function (response) {
		if(response == '<b style="color:green;">Password Updated Correctly</b>') {
			$('#form_response_text').html(response);
			$('.change_pw_container').hide();
		} else {
		$('#form_response_text').html(response);
		}
	}
	});
});

 </script>