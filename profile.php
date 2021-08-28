<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();
?>

<div class="mainContent container text-center">
    <p><b>Username:</b> <?php echo getUsernameDetail($_SESSION['user_id']); ?></p>
    <p><b>Role:</b> <?php if(IsAdmin($_SESSION['user_id'])){ echo 'Admin';} else { echo 'User';}?></p>
    <p><b>Email:</b> <?php echo getUserEmail($_SESSION['user_id']); ?></p>
    <button id="change_pw_btn" class="btn btn-secondary dialog_launcher" data-id="1" data-name="Change Password">Change Password</button>
    <button id="change_theme_btn" class="btn btn-secondary dialog_launcher" data-id="3" data-name="Change Theme">Change Theme</button>
</div>
<script>
$("#change_pw_btn").click(function(){
    $("#change_pw_con").load("changepassword.php", function(responseTxt, statusTxt, xhr){});	
});
$("#change_theme_btn").click(function(){
    $("#change_theme_con").load("changetheme.php", function(responseTxt, statusTxt, xhr){});	
});
$("#change_theme_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
$("#change_pw_btn").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
    $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});
</script>
