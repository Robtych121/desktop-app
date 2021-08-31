<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
$selectedAccount = getFinanceAccDetail($_GET['faccid']);
if ($_POST)
{
    $acc_name = clean_data($_POST['acc_name']);
    $acc_description = clean_data($_POST['acc_description']);
    $acc_currency = clean_data($_POST['acc_currency']);
    $edit_finance_acc_id = clean_data($_POST['edit_finance_acc_id']);

    UpdateFinanceAccount($acc_name, $acc_description, $acc_currency, $edit_finance_acc_id);
    echo '<div class="alert alert-success text-center" role="alert">Account Updated</div>';
    exit();
}

?>

<div class="mainContent container">
    <div class="row">
        <div id="finance_edit_account_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row finance_edit_account_con">
    
        <div class="col-md-12 text-center ml-auto mr-auto login_form">
            <p>For: <b><?php echo $selectedAccount[0]; ?></b></p>
            <form id="finance_editAccount" action="finance_editaccount.php" method="POST">
            <input type="hidden" name="edit_finance_acc_id" id="edit_finance_acc_id" value="<?php echo($_GET['faccid']); ?>">
            <div class="form-group">
                <label for="acc_name">Name</label>
                <input type="text" class="form-control" id="acc_name" name="acc_name" required value="<?php echo $selectedAccount[0]; ?>">
            </div>
            <div class="form-group">
                <label for="acc_description">Description</label>
                <input type="text" class="form-control" id="acc_description" name="acc_description" required value="<?php echo $selectedAccount[1]; ?>">
            </div>
            <div class="form-group">
                <label for="acc_currency">Currency</label>
                <input type="text" class="form-control" id="acc_currency" name="acc_currency" required value="<?php echo $selectedAccount[2]; ?>">
            </div>
            <button type="submit" class="btn btn-outline-secondary">Edit</button>
            </form>
        </div>
    </div>
</div>
<script>

$('#finance_editAccount').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'finance_editaccount.php',
	data: $('#finance_editAccount').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">Account Updated</div>') {
			$('#finance_edit_account_form_response_text').html(response);
            $('.finance_edit_account_con').hide();
            $("#finance_accounts_con").load("finance_accounts.php", function(responseTxt, statusTxt, xhr){});
		} else {
		    $('#finance_edit_account_form_response_text').html(response);
		}
	}
	});
});

 </script>