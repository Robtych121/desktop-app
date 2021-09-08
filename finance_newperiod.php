<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
if (!empty($_POST['per_name']) && !empty($_POST['per_startdate']) && !empty($_POST['per_enddate']))
{
    $per_name = clean_data($_POST['per_name']);
    $per_startdate = clean_data($_POST['per_startdate']);
    $per_enddate = clean_data($_POST['per_enddate']);
     
    finance_createpPeriod($per_name,$per_startdate,$per_enddate);
    echo '<div class="alert alert-success text-center" role="alert">New Period Has Been Created</div>';
    exit();
}


?>

<div class="mainContent container">
    <div class="row">
        <div id="new_finance_period_form_response_text" class="col-12">

        </div>
    </div>
    <div class="row finance_new_period_con">
        <div class="col-md-12 text-center ml-auto mr-auto">
            <form id="finance_newperiod" action="finance_newperiod.php" method="POST">
            <div class="form-group">
                <label for="per_name">Name</label>
                <input type="text" class="form-control" id="per_name" name="per_name" required>
            </div>
            <div class="form-group">
                <label for="per_startdate">Start Date</label>
                <input type="date" class="form-control" id="per_startdate" name="per_startdate" required>
            </div>
            <div class="form-group">
                <label for="per_enddate">End Date</label>
                <input type="date" class="form-control" id="per_enddate" name="per_enddate" required>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Create Period</button>
            </form>
        </div>
    </div>
</div>
<script>
$('#finance_newperiod').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'finance_newperiod.php',
	data: $('#finance_newperiod').serialize(),
	success: function (response) {
		if(response == '<div class="alert alert-success text-center" role="alert">New Period Has Been Created</div>') {
			$('#new_finance_period_form_response_text').html(response);
            $('.finance_new_period_con').hide();
            $("#finance_periods_con").load("finance_periods.php", function(responseTxt, statusTxt, xhr){});
		} else {
		$('#new_finance_period_form_response_text').html(response);
		}
	}
	});
});

 </script>