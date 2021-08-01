<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
$selectedUser = getUserDetail($_GET['userid']);
if ($_POST)
{

    $delete_user_id = clean_data($_POST['delete_user_id']);

    deleteUser($delete_user_id);
    echo '<div class="alert alert-success text-center" role="alert">User Deleted</div>';
    exit();
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="admin_delete_user_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row admin_delete_user_con">
    
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <p>For: <b><?php echo $selectedUser[0]; ?></b></p>
            <form id="admin_deleteuser" action="admin_deleteuser.php" method="POST">
            <input type="hidden" name="delete_user_id" id="delete_user_id" value="<?php echo($_GET['userid']); ?>">
            <p>Please type <b>DELETE</b> to confirm deletion of this user.</p>
            <div class="form-group">
                <input type="text" class="form-control" id="delete_confirm" name="delete_confirm">
            </div>
            <button type="submit" class="btn btn-outline-secondary">Delete</button>
            </form>
        </div>
    </div>
</div>
<script>

$('#admin_deleteuser').on('submit', function (e) {
    e.preventDefault();
    $confirmation = $("#delete_confirm").val();

    if($confirmation == 'DELETE'){
        e.preventDefault();
        $.ajax({
        type: 'post',
        url: 'admin_deleteuser.php',
        data: $('#admin_deleteuser').serialize(),
        success: function (response) {
            if(response == '<div class="alert alert-success text-center" role="alert">User Deleted</div>') {
                $('#admin_delete_user_form_response_text').html(response);
                $('.admin_delete_user_con').hide();
                $("#admin_con").load("admin.php", function(responseTxt, statusTxt, xhr){});
            }
        }
        });
    } else {
        $('#admin_delete_user_form_response_text').html('<div class="alert alert-danger text-center" role="alert">Please Confirm</div>');
    }
	
});

 </script>