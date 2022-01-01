<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
?>

<div class="mainContent container text-center">
<p><button id="newperiodaccount_admin_btn" class="btn btn-secondary dialog_launcher" data-id="21" data-name="New Period">New Period</button></p>
<table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Start Dare</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Out</th>
                    <th scope="col">In</th>
                    <th scope="col">Free</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?=finance_getPeriods();?>
            </tbody>
            </table>
</div>
<script>
    $("#newperiodaccount_admin_btn").click(function(){
    $("#finance_new_periods_con").load("finance_newperiod.php", function(responseTxt, statusTxt, xhr){});	
});


    $(".dialog_launcher").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
        $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});

$(".ViewPeriod_finance_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    data_fperid = $(this).attr("data-fperid");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'').attr("data_fperid", data_fperid);
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
</script>