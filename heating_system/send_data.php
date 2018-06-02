<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newheatingmonitor =json_decode($_GET['pmt_heating_system_data'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_heating_system_data (device_id, housetemp, thermostatTemp) VALUES (:device_id, :housetemp, :thermostatTemp)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":device_id",$newheatingmonitor ['device_id'], PDO::PARAM_INT);
    $createStatement->bindParam(":housetemp",$newheatingmonitor ['housetemp'], PDO::PARAM_STR);
    $createStatement->bindParam(":thermostatTemp",$newheatingmonitor ['thermostatTemp'], PDO::PARAM_STR);

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_heating_system_data where device_id = :device_id";
        $selectStatement = $pdo->prepare($sql);
        $selectStatement->bindParam(":device_id",$pdo->lastInsertId(), PDO::PARAM_INT);
        $selectStatement->execute();
        if ($selectStatement->rowCount()>0){
            echo json_encode($selectStatement->fetch(PDO::FETCH_ASSOC));
        }
    }ELSE {
		var_dump ($pdo->errorInfo());
	}

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}