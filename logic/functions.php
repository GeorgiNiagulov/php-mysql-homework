<?php

function find_contact_by_id($contactId, $mysqli) {

    $safeContactId = mysqli_real_escape_string($mysqli, $contactId);

    $query = "SELECT * FROM `contact_data` WHERE id = {$safeContactId}";

    $contactSet = mysqli_query($mysqli, $query);
    if($contact = mysqli_fetch_assoc($contactSet)) {
        return $contact;
    } else {
        return null;
    }

}

function updateTableById($table, $arrayToSave, $id, $mysqli) {
	$sqlSetClouse = [];
	foreach($arrayToSave as $column => $value) {
		$sqlSetClouse[] = "`{$column}` = '{$value}'";
	}
	if(!empty($sqlSetClouse)) {
		$sqlSetClouse = implode(',', $sqlSetClouse);
	}
	
	$sql = "UPDATE {$table} 
			SET {$sqlSetClouse}
			WHERE id = '{$id}'";
	if (mysqli_query($mysqli, $sql) === TRUE) {
		mysqli_close($mysqli);
		header('Location: index.php');
	} else {
		echo "Error updating record: " . $mysqli->error;
	}
}




