<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Africa/Lagos');

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}



if(isset($_POST["checkin"]) && $_POST["checkin"] == "checked"){

//Check if signed in for the day
include 'dbconnect.php';
  try {
    $date = date('m/d/Y', time());
  $data = $conn->prepare("SELECT timeout FROM attendance WHERE userId=:userId AND date=:date");
  $data->bindParam(':userId', $_SESSION["id"]);
  $data->bindParam(':date', $date);
  $data->execute();
  if($data->rowCount() > 0){
    echo "Please, you have checked in for the day!";
    $conn = null;
    exit();
  }
  if(get_client_ip() != "::1"){
      echo "Your PC is not authorized for this operation!";
      exit();
  }
  }
  catch(PDOException $e)
      {
          echo "Error: " . $e->getMessage();
      }
 
//Check if signed in for the day ends



    try {
        // prepare sql and bind parameters
        session_start();
        $date = date('m/d/Y', time());
        $timein = date('h:i:s A', time());

        $data = $conn->prepare("INSERT INTO attendance(userId, timein, date) 
        VALUES (:userid, :timein, :date)");
        $data->bindParam(':userid', $_SESSION["id"]);
        $data->bindParam(':timein', $timein);
        $data->bindParam(':date', $date);
        
        //execute query to insert into row
        $data->execute();
        // echo "ok";
        }
    catch(PDOException $e)
        {
            // echo "Error: " . $e->getMessage();
        }
        $conn = null;
}

//Timeout
if(isset($_POST["checkout"]) && $_POST["checkout"] == "checked"){
//check Ip address
if(get_client_ip() != "::1"){
    echo "Your PC is not authorized for this operation!";
    exit();
}

    include 'dbconnect.php';
        session_start();
        $date = date('m/d/Y', time());
        $timeout = date('h:i:s A', time());

        try {
            // prepare sql and bind parameters
            $data = $conn->prepare("UPDATE attendance SET timeout=:timeout WHERE userId=:userid AND date=:date");
            $data->bindParam(':userid', $_SESSION["id"]);
            $data->bindParam(':timeout', $timeout);
            $data->bindParam(':date', $date);
            //execute query to insert into row
            $data->execute();
            // echo "ok";
            }
        catch(PDOException $e)
            {
            // echo "Error: " . $e->getMessage();
            }
        $conn = null;
}