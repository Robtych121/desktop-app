<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
$selectedAccount = getFinanceAccDetail($_GET['faccid']);
if ($_POST)
{

    $delete_finance_acc_id = clean_data($_POST['delete_finance_acc_id']);

    deleteFinanceAccount($delete_finance_acc_id);
    echo '<div class="alert alert-success text-center" role="alert">Account Deleted</div>';
    exit();
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="finance_delete_account_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row finance_delete_account_con">
    
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <p>For: <b><?php echo $selectedUser[0]; ?></b></p>
            <form id="finance_deleteaccount" action="finance_deleteaccount.php" method="POST">
            <input type="hidden" name="delete_finance_acc_id" id="delete_finance_acc_id" value="<?php echo($_GET['faccid']); ?>">
            <p>Please type <b>DELETE</b> to confirm deletion of this account.</p>
            <div class="form-group">
                <input type="text" class="form-control" id="delete_confirm" name="delete_confirm">
            </div>
            <button type="submit" class="btn btn-outline-secondary">Delete</button>
            </form>
        </div>
    </div>
</div>
<script>

$('#finance_deleteaccount').on('submit', function (e) {
    e.preventDefault();
    $confirmation = $("#delete_confirm").val();

    if($confirmation == 'DELETE'){
        e.preventDefault();
        $.ajax({
        type: 'post',
        url: 'finance_deleteaccount.php',
        data: $('#finance_deleteaccount').serialize(),
        success: function (response) {
            if(response == '<div class="alert alert-success text-center" role="alert">Account Deleted</div>') {
                $('#finance_delete_account_form_response_text').html(response);
                $('.finance_delete_account_con').hide();
                $("#finance_accounts_con").load("finance_accounts.php", function(responseTxt, statusTxt, xhr){});
            }
        }
        });
    } else {
        $('#finance_delete_account_form_response_text').html('<div class="alert alert-danger text-center" role="alert">Please Confirm</div>');
    }
	
});

 </script>