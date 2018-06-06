<?php
session_start();
if(isset($_SESSION['id'])){
include 'dbconnect.php';
try {
$data = $conn->prepare("SELECT * FROM attendance WHERE (userId=:userId)");
$data->bindParam(':userId', $_SESSION['id']);
$data->execute();
$result=[];
foreach ($data->fetchAll(PDO::FETCH_ASSOC) as $row) {
    array_push($result,$row);
    }
    echo json_encode($result);
}
catch(PDOException $e)
    {
        $error_empty = "Error: " . $e->getMessage();
    }
    $conn = null;
}