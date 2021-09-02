<?php 

function finance_getAccounts(){
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
                        <button type="button" data-faccid="'.$aid.'" data-id="19" data-name="Edit Account" class="editAccount_finance_btn btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                        <button type="button" data-faccid="'.$aid.'" data-id="20" data-name="Delete Account" class="deleteAccount_finance_btn btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>';

        $out .= "</tr>";
	}

	return $out;
	exit();

}

function finance_createAccount($acc_name,$acc_description,$acc_currency){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('INSERT INTO accounts(name, description, currency) VALUES (?, ?, ?)');
    $stmt -> bind_param('sss', $acc_name, $acc_description, $acc_currency);
    $stmt -> execute();
    $stmt -> close();
}

function getFinanceAccDetail($acc_id){
    include 'includes/config/db_connection.php';	
	$stmt = $conn->prepare('SELECT name, description, currency, balance FROM accounts WHERE id = ?');
    $stmt -> bind_param('i', $acc_id);
    $stmt -> execute();
    $stmt -> bind_result($name, $description, $currency, $balance);
	$result = $stmt->get_result();
	$data = $result->fetch_array();
	$stmt -> close();
    return $data;
}

function UpdateFinanceAccount($acc_name, $acc_description, $acc_currency, $edit_finance_acc_id){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE accounts SET name = ?, description = ?, currency = ? WHERE id = ?');
    $stmt -> bind_param('ssss', $acc_name,$acc_description,$acc_currency,$edit_finance_acc_id);
    $stmt -> execute();
    $stmt -> close();
}

function deleteFinanceAccount($finance_acc_id){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('DELETE FROM accounts WHERE id = ?');
    $stmt -> bind_param('s', $finance_acc_id);
    $stmt -> execute();
    $stmt -> close();
}

?>