<?php
ob_start();
include 'includes/init.php';
include 'includes/templates/head.php';
include 'includes/templates/topbar.php';
LoggedOutRedirect();
?>
    <style>
        body {
            background: url(<?=getThemeDetail('1', $_SESSION['user_id']) ?>);
        }
        .taskbar{
            background-color: <?=getThemeDetail('2', $_SESSION['user_id']) ?>;
        }
        .ui-widget.ui-widget-content{
            background: <?=getThemeDetail('3', $_SESSION['user_id']) ?>;
            border: 1px solid <?=getThemeDetail('3', $_SESSION['user_id']) ?>;
        }
        .ui-widget-header{
            color: <?=getThemeDetail('8', $_SESSION['user_id']) ?>;
            background: <?=getThemeDetail('7', $_SESSION['user_id']) ?>;
            border: 1px solid <?=getThemeDetail('7', $_SESSION['user_id']) ?>;
        }
        .btn-secondary, .homepage_link_con {
            color:  <?=getThemeDetail('4', $_SESSION['user_id']) ?>;
            background-color: <?=getThemeDetail('5', $_SESSION['user_id']) ?>;
            border: 1px solid <?=getThemeDetail('5', $_SESSION['user_id']) ?>;
        }
        .btn-secondary:hover, .homepage_link_con:hover {
            background-color: <?=getThemeDetail('6', $_SESSION['user_id']) ?>;
            border: 1px solid <?=getThemeDetail('6', $_SESSION['user_id']) ?>;
        }
    </style>
<div class="homepage_con">
    <a class="homepage_link dialog_launcher" id="hp_profile_btn" data-id="2" data-name="My Profile">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="fas fa-sliders-h fa-3x"></i><br>
                My Profile
            </p>
        </div>
    </a>
    <a class="homepage_link dialog_launcher" id="hp_financefolder_btn" data-id="9" data-name="Finance">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="far fa-folder-open fa-3x"></i><br>
                Finance
            </p>
        </div>
    </a>
    <?php if(IsAdmin($_SESSION['user_id'])){ echo '<a class="homepage_link dialog_launcher" id="hp_admin_btn" data-id="4" data-name="Administration">
        <div class="homepage_link_con text-center">
            <p style="margin: auto;">
                <i class="fas fa-user-shield fa-3x"></i><br>
                Admin
            </p>
        </div>
    </a>';}?>
    
</div>
<div id="change_pw_con" class="dialog" data-id="1"></div>
<div id="profile_con" class="dialog" data-id="2"></div>
<div id="change_theme_con" class="dialog" data-id="3"></div>
<?php if(IsAdmin($_SESSION['user_id'])){ echo '<div id="admin_con" class="dialog" data-id="4"></div>';}?>
<?php if(IsAdmin($_SESSION['user_id'])){ echo '<div id="newUser_admin_con" class="dialog" data-id="5"></div>';}?>
<?php if(IsAdmin($_SESSION['user_id'])){ echo '<div id="editUser_admin_con" class="dialog" data-id="6" data_userid="0"></div>';}?>
<?php if(IsAdmin($_SESSION['user_id'])){ echo '<div id="deleteUser_admin_con" class="dialog" data-id="7" data_userid="0"></div>';}?>
<?php if(IsAdmin($_SESSION['user_id'])){ echo '<div id="serverSettings_admin_con" class="dialog" data-id="8"></div>';}?>
<div id="financefolder_con" class="dialog" data-id="9"></div>
<div id="finance_accounts_con" class="dialog" data-id="10"></div>
<div id="finance_periods_con" class="dialog" data-id="11"></div>
<div id="finance_transcations_con" class="dialog" data-id="12"></div>
<div id="finance_budgets_con" class="dialog" data-id="13"></div>
<div id="finance_recurring_con" class="dialog" data-id="14"></div>
<div id="finance_expenses_con" class="dialog" data-id="15"></div>
<div id="finance_debts_con" class="dialog" data-id="16"></div>
<div id="finance_settings_con" class="dialog" data-id="17"></div>
<div id="finance_new_accounts_con" class="dialog" data-id="18"></div>

<?php include 'includes/templates/footer.php';?>