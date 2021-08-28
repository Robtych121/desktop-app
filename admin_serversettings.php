<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
if($_POST)
{
    $register_enabled = clean_data($_POST['register_enabled']);
    updateRegisteration($register_enabled);

    echo '<div class="alert alert-success text-center" role="alert">System Updated</div>';
    exit();
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="form_serversettings_response_text" class="col-12">

        </div>
    </div>
    <div class="row admin_serversetting_con">
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <form id="admin_serversetting" action="admin_serversetting.php" method="POST">
            <div class="form-group">
                <label for="register_enabled">Register Enabled</label>
                <select class="form-control" aria-label="Default select example" id="register_enabled" name="register_enabled">
                    <option value="0" <?php if(isRegisterEnabled() == false){ echo 'selected';} ?>>Disabled</option>
                    <option value="1" <?php if(isRegisterEnabled() == true){ echo 'selected';} ?>>Enabled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Save Settings</button>
            </form>
        </div>
    </div>
</div>
<script>
$('#admin_serversetting').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'admin_serversettings.php',
	data: $('#admin_serversetting').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">System Updated</div>') {
			$('#form_serversettings_response_text').html(response);
            $('.admin_serversetting_con').hide();
		} else {
		$('#form_serversettings_response_text').html(response);
		}
	}
	});
});

 </script>