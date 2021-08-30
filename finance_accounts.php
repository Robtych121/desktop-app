<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
?>

<div class="mainContent container text-center">
<p><button id="newfinanceaccount_admin_btn" class="btn btn-secondary dialog_launcher" data-id="18" data-name="New Account">New Account</button></p>
<table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?=finance_getAccounts();?>
            </tbody>
            </table>
</div>
<script>
$("#newfinanceaccount_admin_btn").click(function(){
    $("#finance_new_accounts_con").load("finance_newaccount.php", function(responseTxt, statusTxt, xhr){});	
});
$(".dialog_launcher").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
        $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
</script>