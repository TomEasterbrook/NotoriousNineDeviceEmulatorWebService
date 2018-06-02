<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newwatermonitor =json_decode($_GET['pmt_water_monitor_data'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_water_monitor_data (device_id, water_used, waste_water) VALUES (:device_id, :water_used, :waste_water)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":device_id",$newwatermonitor ['device_id'], PDO::PARAM_INT);
    $createStatement->bindParam(":water_used",$newwatermonitor ['water_used'], PDO::PARAM_STR);
     $createStatement->bindParam(":waste_water",$newwatermonitor ['waste_water'], PDO::PARAM_STR);	

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_water_monitor_data where device_id = :device_id";
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
