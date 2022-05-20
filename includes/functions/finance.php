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

function finance_getPeriods(){
    include 'includes/config/db_connection.php';
    $out ="";

	$stmt = $conn -> prepare("SELECT periodId, periodName, startDate, endDate, totalOut, totalIn, freeCash FROM periods");
	$stmt -> execute();
	$stmt -> bind_result($peridID, $periodName, $startDate, $endDate, $totalOut, $totalIn, $freeCash);

	while($stmt -> fetch()){

        $out .= "
                <tr>
                    <td>$peridID</td>
                    <td>$periodName</td>
                    <td>$startDate</td>
                    <td>$endDate</td>
                    <td>$totalOut</td>
                    <td>$totalIn</td>
                    <td>$freeCash</td>
                ";
        $out .= '<td>
                    <div class="btn-group btn-group-sm"" role="group" aria-label="Basic example">
                        <button type="button" data-fperid="'.$peridID.'" data-id="22" data-name="View Period" class="ViewPeriod_finance_btn btn btn-secondary"><i class="fas fa-folder-open"></i></button>    
                        <button type="button" data-fperid="'.$peridID.'" data-id="23" data-name="Edit Period" class="editPeriod_finance_btn btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                        <button type="button" data-fperid="'.$peridID.'" data-id="24" data-name="Delete Period" class="deletePeriod_finance_btn btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>';

        $out .= "</tr>";
	}

	return $out;
	exit();

}

function finance_createpPeriod($per_name,$per_startdate,$per_enddate){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('INSERT INTO periods(periodName, startDate, endDate) VALUES (?, ?, ?)');
    $stmt -> bind_param('sss', $per_name, $per_startdate, $per_enddate);
    $stmt -> execute();
    $stmt -> close();
}

function getPeriodDetail($user_id){
	include 'includes/config/db_connection.php';	
	$stmt = $conn->prepare('SELECT periodName, startDate, endDate, startBalance, endBalance, totalIn, totalOut, freeCash, status FROM periods WHERE periodId = ?');
    $stmt -> bind_param('i', $user_id);
    $stmt -> execute();
    $stmt -> bind_result($periodName, $startDate, $endDate, $startBalance, $endBalance, $totalIn, $totalOut, $freeCash, $status);
	$result = $stmt->get_result();
	$data = $result->fetch_array();
	$stmt -> close();
    return $data;
}

function updateTotalIn(){
    include 'includes/config/db_connection.php';
    
}

?>