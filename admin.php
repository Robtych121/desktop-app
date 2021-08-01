<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
AdminRedirect($_SESSION['user_id']);
?>

<div class="mainContent container text-center">
<div class="row admin_container">
	<div class="col-12">
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="userAdmin-tab" data-toggle="tab" href="#userAdmin" role="tab" aria-controls="userAdmin" aria-selected="true">Users</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="serverAdmin-tab" data-toggle="tab" href="#serverAdmin" role="tab" aria-controls="serverAdmin" aria-selected="false">Server</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="appsAdmin-tab" data-toggle="tab" href="#appsAdmin" role="tab" aria-controls="appsAdmin" aria-selected="false">Apps</a>
        </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="userAdmin" role="tabpanel" aria-labelledby="userAdmin-tab">
        <p><button id="newUser_admin_btn" class="btn btn-secondary dialog_launcher" data-id="5" data-name="New User">New User</button></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Active</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?=getUserList();?>
            </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="serverAdmin" role="tabpanel" aria-labelledby="serverAdmin-tab">
            <button id="systemSettings_admin_btn" type="button" data-id="8" data-name="Server Settings" class="btn btn-secondary btn-lg btn-block">Server Settings</button>
        </div>
        <div class="tab-pane fade" id="appsAdmin" role="tabpanel" aria-labelledby="appsAdmin-tab">
            Apps goes heres
        </div>
    </div>
	</div>
</div>
</div>
<script>
$("#newUser_admin_btn").click(function(){
    $("#newUser_admin_con").load("admin_newuser.php", function(responseTxt, statusTxt, xhr){});	
});
$(".editUser_admin_btn").click(function(){
    data_userid = $(this).attr("data-userid");
    $("#editUser_admin_con").load("admin_edituser.php?userid="+data_userid+"", function(responseTxt, statusTxt, xhr){});	
});
$(".deleteUser_admin_btn").click(function(){
    data_userid = $(this).attr("data-userid");
    $("#deleteUser_admin_con").load("admin_deleteuser.php?userid="+data_userid+"", function(responseTxt, statusTxt, xhr){});	
});
$("#systemSettings_admin_btn").click(function(){
    $("#serverSettings_admin_con").load("admin_serversettings.php", function(responseTxt, statusTxt, xhr){});	
});

$("#newUser_admin_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
$(".editUser_admin_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    data_userid = $(this).attr("data-userid");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'').attr("data_userid", data_userid);
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});

$(".deleteUser_admin_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    data_userid = $(this).attr("data-userid");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'').attr("data_userid", data_userid);
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
$("#systemSettings_admin_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
</script>