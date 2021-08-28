<div class="container-fluid taskbar">
<table class="table table-borderless">
	<tr>
		<td>
		<div class="dropup">
				<button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Start Menu
				</button>
				<div class="dropdown-menu startmenu">
					<div class="startmenu_user"><?php echo getUsernameDetail($_SESSION['user_id']); ?></div>
					<div class="startmenu_options">
					<a class="dropdown-item dialog_launcher" id="financefolder_btn" data-id="9" data-name="Finance">Finance</a>
					<a class="dropdown-item dialog_launcher" id="profile_btn" data-id="2" data-name="My Profile">My Profile</a>
					<?php if(IsAdmin($_SESSION['user_id'])){ echo '<a class="dropdown-item dialog_launcher" id="admin_btn" data-id="4" data-name="Administration">Administration</a>';}?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.php">Logout</a>
				</div>
			</div>
		</div>
		</td>
		<td><div id="openedModals"></div></td>
		<td><div class="ClockContainer">
			<div id="MyDateDisplay" class="clock" onload="showTime()"></div>
			<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
		</div></td>
	</tr>
</table>	
</div>
<script src="assets/js/scripts.js"></script>
</body>
</html>