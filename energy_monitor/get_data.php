<?php
$connectionString = '';
$user = '';
$password = '';

try {
    $pdo = new PDO($connectionString, $user, $password);
    $sql = "SELECT * FROM pmt_energy_monitor_data where device_id = :device_id ORDER BY data_submitted desc ";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":device_id",$_GET['device_id'], PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount()>0){
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
