<?php

function setAdminPassword(){
    include 'includes/config/db_connection.php';
    $newps = password_hash('welcome', PASSWORD_DEFAULT);
    $stmt = $conn->prepare('UPDATE users SET password=? WHERE id = 1');
    $stmt -> bind_param('s', $newps);
    $stmt -> execute();
    $stmt -> close();
}

function LoggedInRedirect(){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    } 
}

function IsLoggedIn(){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        return true;
    }
}

function LoggedOutRedirect(){
    if(!isset($_SESSION["loggedin"])){
        header("location: login.php");
        exit;
    } 
}


function getUserIDFromDB($uid, $pid){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE username =? AND password =? LIMIT 1');
    $stmt -> bind_param('ss', $uid, $pid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($id);
    $stmt -> fetch();
    $stmt -> close();
    return $id;
}


function checkUserPassword($uid){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT password FROM users WHERE username =? AND active = 1 LIMIT 1');
    $stmt -> bind_param('s', $uid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($pid);
    $stmt -> fetch();
    $stmt -> close();
    return $pid;
}

function checkUsernameAlreadyExists($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE username =?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}


function checkEmailAlreadyExists($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE email =?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}


function registerUser($input, $activationKey){
    $new_ps = password_hash($input['password'], PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('INSERT INTO users(username, email, password, activationKey) VALUES (?, ?, ?, ?)');
    $stmt -> bind_param('ssss', $input['username'], $input['email'], $new_ps, $activationKey);
    $stmt -> execute();
    $stmt -> close();
}


function checkUserIsActive($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT active FROM users WHERE username =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUsernameDetail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT username FROM users WHERE id =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUserEmail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT email FROM users WHERE id =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUsernameFromEmailDetail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT username FROM users WHERE email =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function activateAccount($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET active= 1 WHERE activationKey = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> close();

    $stmt = $conn->prepare('SELECT id FROM users WHERE active = 1 AND activationKey = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}

function SetRecoveryKey($email, $key){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET recoveryKey= ? WHERE email = ?');
    $stmt -> bind_param('ss', $key, $email);
    $stmt -> execute();
    $stmt -> close();
}


function recoverAccount($input, $recoveryKey){
    $new_ps = password_hash($input, PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET password= ? WHERE recoveryKey = ?');
    $stmt -> bind_param('ss', $new_ps, $recoveryKey);
    $stmt -> execute();
    $stmt -> close();

    $stmt = $conn->prepare('SELECT id FROM users WHERE password = ? AND recoveryKey = ?');
    $stmt -> bind_param('ss', $new_ps, $recoveryKey);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}

function clearActivationKey($input){
    $key = '';
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET activationKey = ? WHERE activationKey = ?');
    $stmt -> bind_param('ss', $key, $input);
    $stmt -> execute();
    $stmt -> close();  
}


function clearRecoveryKey($input){
    $key = '';
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET recoveryKey = ? WHERE recoveryKey = ?');
    $stmt -> bind_param('ss', $key, $input);
    $stmt -> execute();
    $stmt -> close();  
}


function changePassword($uid, $pid) {
    $new_ps = password_hash($pid, PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt -> bind_param('ss', $new_ps, $uid);
    $stmt -> execute();
    $stmt -> close();
}

function getThemeDetail($type, $uid){
    include 'includes/config/db_connection.php';
    # Type 1 = Theme Background
    # Type 2 = Taskbar Colour
    # Type 3 = Window Colour
    # Type 4 = Button Text Colour
    # Type 5 = Button Colour
    # Type 6 = Button Hover Colour
    if($type == 1){
        $stmt = $conn->prepare('SELECT theme_bg FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 2){
        $stmt = $conn->prepare('SELECT taskbar_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 3){
        $stmt = $conn->prepare('SELECT window_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 4){
        $stmt = $conn->prepare('SELECT button_text_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 5){
        $stmt = $conn->prepare('SELECT button_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 6){
        $stmt = $conn->prepare('SELECT button_hover_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 7){
        $stmt = $conn->prepare('SELECT window_header_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
    if($type == 8){
        $stmt = $conn->prepare('SELECT window_header_text_colour FROM users WHERE id =? LIMIT 1');
        $stmt -> bind_param('s', $uid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($active);
        $stmt -> fetch();
        $stmt -> close();
        return $active;
    }
}

function updateTheme($userid,$theme_bg,$taskbar_colour,$window_colour,$window_header_colour,$window_header_text_colour,$button_text_colour,$button_colour,$button_hover_colour){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET theme_bg = ?, taskbar_colour = ?, window_colour = ?, window_header_colour = ?, window_header_text_colour = ?, button_text_colour = ?, button_colour = ?, button_hover_colour = ? WHERE id = ?');
    $stmt -> bind_param('sssssssss', $theme_bg,$taskbar_colour,$window_colour,$window_header_colour,$window_header_text_colour,$button_text_colour,$button_colour,$button_hover_colour,$userid);
    $stmt -> execute();
    $stmt -> close();
}

function isAdmin($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT is_admin FROM users WHERE id = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found == 1)
    {
        return true;
    } else {
        return false;
    }
}

function AdminRedirect($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT is_admin FROM users WHERE id = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found == 1)
    {
        return true;
    } else {
        header("location: index.php");
        exit;
    }
}

function getUserList(){
    include 'includes/config/db_connection.php';
    $out ="";

	$stmt = $conn -> prepare("SELECT id, username, email, active, is_admin FROM users");
	$stmt -> execute();
	$stmt -> bind_result($pid, $username, $email, $active, $is_admin);

	while($stmt -> fetch()){

        $out .= "
                <tr>
                    <td>$pid</td>
                    <td>$username</td>
                    <td>$email</td>
                ";
        if($active == 1){
            $out .= "<td>Yes</td>";
        } else {
            $out .= "<td>No</td>";
        }
        if($is_admin == 1){
            $out .= "<td>Admin</td>";
        } else {
            $out .= "<td>User</td>";
        }
        $out .= '<td>
                    <div class="btn-group btn-group-sm"" role="group" aria-label="Basic example">
                        <button type="button" data-userid="'.$pid.'" data-id="6" data-name="Edit User" class="editUser_admin_btn btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                        <button type="button" data-userid="'.$pid.'" data-id="7" data-name="Delete User" class="deleteUser_admin_btn btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>';

        $out .= "</tr>";
	}

	return $out;
	exit();

}

function isRegisterEnabled(){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT allow_register FROM system_settings');
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found == 1)
    {
        return true;
    } else {
        return false;
    }
}

function RegisterRedirect(){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT allow_register FROM system_settings');
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found == 1)
    {
        return true;
    } else {
        header("location: index.php");
        exit;
    }
}

function getUserDetail($user_id){
	include 'includes/config/db_connection.php';	
	$stmt = $conn->prepare('SELECT username, email, active, is_admin FROM users WHERE id = ?');
    $stmt -> bind_param('i', $user_id);
    $stmt -> execute();
    $stmt -> bind_result($username, $email, $active, $isadmin);
	$result = $stmt->get_result();
	$data = $result->fetch_array();
	$stmt -> close();
    return $data;
}

function updateUser($userid, $active, $role){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET active = ?, is_admin = ? WHERE id = ?');
    $stmt -> bind_param('sss', $active,$role,$userid);
    $stmt -> execute();
    $stmt -> close();
}

function deleteUser($userid){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt -> bind_param('s', $userid);
    $stmt -> execute();
    $stmt -> close();
}

function updateRegisteration($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE system_settings SET allow_register = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> close();
}

?>