<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
if (!empty($_POST['acc_name']) && !empty($_POST['acc_description']) && !empty($_POST['acc_currency']))
{
    $acc_name = clean_data($_POST['acc_name']);
    $acc_description = clean_data($_POST['acc_description']);
    $acc_currency = clean_data($_POST['acc_currency']);
     
    finance_createAccount($acc_name,$acc_description,$acc_currency);
    echo '<div class="alert alert-success text-center" role="alert">New Account Has Been Created</div>';
    exit();
}


?>

<div class="mainContent container">
    <div class="row">
        <div id="new_finance_account_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row finance_new_account_con">
        <div class="col-md-12 text-center ml-auto mr-auto">
            <form id="finance_newaccount" action="finance_newaccount.php" method="POST">
            <div class="form-group">
                <label for="acc_name">Name</label>
                <input type="text" class="form-control" id="acc_name" name="acc_name" required>
            </div>
            <div class="form-group">
                <label for="acc_description">Description</label>
                <input type="text" class="form-control" id="acc_description" name="acc_description" required>
            </div>
            <div class="form-group">
                <label for="acc_currency">Currency</label>
                <input type="text" class="form-control" id="acc_currency" name="acc_currency" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Create Account</button>
            </form>
        </div>
    </div>
</div>
<script>
$('#finance_newaccount').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'finance_newaccount.php',
	data: $('#finance_newaccount').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">New Account Has Been Created</div>') {
			$('#new_finance_account_form_response_text').html(response);
            $('.finance_new_account_con').hide();
            $("#finance_accounts_con").load("finance_accounts.php", function(responseTxt, statusTxt, xhr){});
		} else {
		$('#new_finance_account_form_response_text').html(response);
		}
	}
	});
});

 </script>