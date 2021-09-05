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