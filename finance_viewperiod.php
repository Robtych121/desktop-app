<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
$selectedPeriod = getPeriodDetail($_GET['fperid']);
?>

<div class="mainContent container">

<div class="row">
    <div class="col-12">
    <h3>Name: <b><?php echo $selectedPeriod[0]; ?></b></h3>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <p>Start Date: <b><?php echo $selectedPeriod[1]; ?></b></p>
        <p>End Date: <b><?php echo $selectedPeriod[2]; ?></b></p>
        <p>Start Balance: <b><?php echo $selectedPeriod[3]; ?></b></p>
        <p>End Balance: <b><?php echo $selectedPeriod[4]; ?></b></p>
    </div>
    <div class="col-6">
        <p>Total In: <b><?php echo $selectedPeriod[5]; ?></b></p>
        <p>Total Out: <b><?php echo $selectedPeriod[6]; ?></b></p>
        <p>Free Cash: <b><?php echo $selectedPeriod[7]; ?></b></p>
        <p>Status: <b><?php  if($selectedPeriod[8] == '1'){ echo 'Active';} else { echo 'Closed';}; ?></b></p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h4>Quick Actions</h4>
        <button id="period_update_totalIn" class="btn btn-secondary" >Update Total In</button>
        <button id="period_update_totalOut" class="btn btn-secondary" >Update Total Out</button>
        <button id="period_update_freeCash" class="btn btn-secondary" >Update Free Cash</button>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h4>Breakdown By Type</h4>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h4>Related Transations</h4>
    </div>
</div>
</div>