<?php
ob_start();
include 'includes/init.php';
?>
<div class="homepage_con row">
    <a class="folder_link dialog_launcher" id="finance_accounts_btn" data-id="10" data-name="Finance - Accounts">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Accounts
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_periods_btn" data-id="11" data-name="Finance - Periods">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Periods
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_transcations_btn" data-id="12" data-name="Finance - Transcations">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Transcations
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_budgets_btn" data-id="13" data-name="Finance - Budgets">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Budgets
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_recurring_btn" data-id="14" data-name="Finance - Recurring">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Recurring
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_expenses_btn" data-id="15" data-name="Finance - Expenses">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Expenses
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_debts_btn" data-id="16" data-name="Finance - Debts">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Debts
            </p>
        </div>
    </a>
    <a class="folder_link dialog_launcher" id="finance_settings_btn" data-id="17" data-name="Finance - Settings">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Settings
            </p>
        </div>
    </a>  
</div>
<script>
$("#finance_accounts_btn").click(function(){
    $("#finance_accounts_con").load("finance_accounts.php", function(responseTxt, statusTxt, xhr){});	
});
$("#finance_periods_btn").click(function(){
    $("#finance_periods_con").load("finance_periods.php", function(responseTxt, statusTxt, xhr){});	
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