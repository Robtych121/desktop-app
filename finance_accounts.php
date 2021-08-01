<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
?>

<div class="mainContent container text-center">
<p><button id="newfinanceaccount_admin_btn" class="btn btn-secondary dialog_launcher" data-id="5" data-name="New Account">New Account</button></p>
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
                <?=getAccounts();?>
            </tbody>
            </table>
</div>
