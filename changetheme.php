<?php
ob_start();
include 'includes/init.php';
LoggedOutRedirect();

if (!empty($_POST['theme_bg']) && !empty($_POST['taskbar_colour']) && !empty($_POST['window_colour']) && !empty($_POST['window_header_colour']) && !empty($_POST['window_header_text_colour']) && !empty($_POST['button_text_colour']) && !empty($_POST['button_colour']) && !empty($_POST['button_hover_colour']) ){

    $theme_bg = $_POST['theme_bg'];
    $taskbar_colour = $_POST['taskbar_colour'];
    $window_colour = $_POST['window_colour'];
    $window_header_colour = $_POST['window_header_colour'];
    $window_header_text_colour = $_POST['window_header_text_colour'];
    $button_text_colour = $_POST['button_text_colour'];
    $button_colour = $_POST['button_colour'];
    $button_hover_colour = $_POST['button_hover_colour'];

    $userid = $_SESSION['user_id'];

    updateTheme($userid,$theme_bg,$taskbar_colour,$window_colour,$window_header_colour,$window_header_text_colour,$button_text_colour,$button_colour,$button_hover_colour);
	echo '<b style="color:green;">Theme Updated. Please logout for changes to take affect</b>';
	exit();
}
?>

<div class="mainContent container text-center">
<div class="row">
	<div id="change_theme_form_response_text" class="col-12">

	</div>
</div>
<div class="row change_theme_container">
	<div class="col-12">
		<form id="changetheme" action="changetheme.php" method="POST">
            <div class="row">
                <div class="col-4">
                    <p><b>General</b></p>
                    <hr>
                    <div class="form-group">
                        <label for="theme_bg">Background Image (URL)</label>
                        <input type="text" class="form-control" id="theme_bg" name="theme_bg" required autocomplete="nope" value="<?=getThemeDetail('1', $_SESSION['user_id']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="taskbar_colour">Taskbar Colour</label>
                        <input type="color" class="form-control" id="taskbar_colour" name="taskbar_colour" required autocomplete="nope" value="<?=getThemeDetail('2', $_SESSION['user_id']) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="window_colour">Window Colour</label>
                        <input type="color" class="form-control" id="window_colour" name="window_colour" required autocomplete="nope" value="<?=getThemeDetail('3', $_SESSION['user_id']) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <p><b>Header</b></p>
                    <hr>
                    <div class="form-group">
                        <label for="window_header_colour">Header Colour</label>
                        <input type="color" class="form-control" id="window_header_colour" name="window_header_colour" required autocomplete="nope" value="<?=getThemeDetail('7', $_SESSION['user_id']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="window_header_text_colour">Header Text Colour</label>
                        <input type="color" class="form-control" id="window_header_text_colour" name="window_header_text_colour" required autocomplete="nope" value="<?=getThemeDetail('8', $_SESSION['user_id']) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <p><b>Buttons</b></p>
                    <hr>
                    <div class="form-group">
                        <label for="button_text_colour">Text Colour</label>
                        <input type="color" class="form-control" id="button_text_colour" name="button_text_colour" required autocomplete="nope" value="<?=getThemeDetail('4', $_SESSION['user_id']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="button_colour">Button Colour</label>
                        <input type="color" class="form-control" id="button_colour" name="button_colour" required autocomplete="nope" value="<?=getThemeDetail('5', $_SESSION['user_id']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="button_hover_colour">Button Hover Colour</label>
                        <input type="color" class="form-control" id="button_hover_colour" name="button_hover_colour" required autocomplete="nope" value="<?=getThemeDetail('6', $_SESSION['user_id']) ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    
                    <button type="submit" class="btn btn-secondary">Change Theme</button>
                </div>
            </div>
		</form>
        <hr>
        <button class="btn btn-secondary" onclick="ResetTheme();">Reset to Defaults</button>
	</div>
</div>
</div>

<script>
function ResetTheme(){
    $("#theme_bg").val("https://desktop.robert-davies.net/assets/img/prism.png");
    $("#taskbar_colour").val("#ffffff");
    $("#window_colour").val("#ffffff");
    $("#window_header_colour").val("#e9e9e9");
    $("#window_header_text_colour").val("#333333");
    $("#button_text_colour").val("#ffffff");
    $("#button_colour").val("#6c757d");
    $("#button_hover_colour").val("#5a6268");
    $('#changetheme').submit();
}

$('#changetheme').on('submit', function (e) {

	e.preventDefault();

	$.ajax({
	type: 'post',
	url: 'changetheme.php',
	data: $('#changetheme').serialize(),
	success: function (response) {
		if(response == '<b style="color:green;">Theme Updated. Please logout for changes to take affect</b>') {
			$('#change_theme_form_response_text').html(response);
			$('.change_theme_container').hide();
		} else {
		$('#change_theme_form_response_text').html(response);
		}
	}
	});
});
 </script>