<?php 

function getAccounts(){
    include 'includes/config/db_connection.php';
    $out ="";

	$stmt = $conn -> prepare("SELECT id, name, description, currency, balance FROM accounts");
	$stmt -> execute();
	$stmt -> bind_result($aid, $name, $description, $currency, $balance);

	while($stmt -> fetch()){

        $out .= "
                <tr>
                    <td>$aid</td>
                    <td>$name</td>
                    <td>$description</td>
                    <td>$currency</td>
                    <td>$balance</td>
                ";
        $out .= '<td>
                    <div class="btn-group btn-group-sm"" role="group" aria-label="Basic example">
                        <button type="button" data-userid="'.$aid.'" data-id="6" data-name="Edit User" class="editUser_admin_btn btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                        <button type="button" data-userid="'.$aid.'" data-id="7" data-name="Delete User" class="deleteUser_admin_btn btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>';

        $out .= "</tr>";
	}

	return $out;
	exit();

}

?>