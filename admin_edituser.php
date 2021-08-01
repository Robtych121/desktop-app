<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
$selectedUser = getUserDetail($_GET['userid']);
if ($_POST)
{
    $active = clean_data($_POST['active']);
    $role = clean_data($_POST['role']);
    $edit_user_id = clean_data($_POST['edit_user_id']);

    updateUser($edit_user_id, $active, $role);
    echo '<div class="alert alert-success text-center" role="alert">User Updated</div>';
    exit();
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="admin_edit_user_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row admin_edit_user_con">
    
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <p>For: <b><?php echo $selectedUser[0]; ?></b></p>
            <form id="admin_edituser" action="admin_edituser.php" method="POST">
            <input type="hidden" name="edit_user_id" id="edit_user_id" value="<?php echo($_GET['userid']); ?>">
            <div class="form-group">
                <label for="active">Active</label>
                <select class="form-control" aria-label="Default select example" id="active" name="active">
                    <option value="0" <?php if($selectedUser[2] == 0){ echo 'selected';} ?>>Inactive</option>
                    <option value="1" <?php if($selectedUser[2] == 1){ echo 'selected';} ?>>Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" aria-label="Default select example" id="role" name="role">
                    <option value="0" <?php if($selectedUser[3] == 0){ echo 'selected';} ?>>User</option>
                    <option value="1" <?php if($selectedUser[3] == 1){ echo 'selected';} ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Edit</button>
            </form>
        </div>
    </div>
</div>
<script>

$('#admin_edituser').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'admin_edituser.php',
	data: $('#admin_edituser').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">User Updated</div>') {
			$('#admin_edit_user_form_response_text').html(response);
            $('.admin_edit_user_con').hide();
            $("#admin_con").load("admin.php", function(responseTxt, statusTxt, xhr){});
		} else {
		    $('#admin_edit_user_form_response_text').html(response);
		}
	}
	});
});

 </script>