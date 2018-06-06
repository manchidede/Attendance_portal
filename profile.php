<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: index.php"); 
exit();
  }

  include 'dbconnect.php';
  try {
    date_default_timezone_set('Africa/Lagos');
    $date = date('m/d/Y', time());
    // $date = '08/04/2018';

  $data = $conn->prepare("SELECT timeout FROM attendance WHERE userId=:userId AND date=:date");
  $data->bindParam(':userId', $_SESSION["id"]);
  $data->bindParam(':date', $date);
  $data->execute();
  if($data->rowCount() > 0){
    $result = $data->fetch(PDO::FETCH_ASSOC);
      if($result["timeout"] != "none"){
        $checkoutstatus = "disabled checked"; 
      }
      $checkinstatus = "disabled checked";
  }else{
    $checkoutstatus = "disabled"; 
  }
  }
  catch(PDOException $e)
      {
          echo "Error: " . $e->getMessage();
      }
  $conn = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/profile.css">
<link rel="stylesheet" href="css/bootstrap4.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
<title>Document</title>
</head>

<body>
<div class="navbar container-fluid">
<h2>Attendance Portal</h2>
<ul>
<li class="profile">Profile</li>
<li class="history">Attendance History</li>
<li class="logout">Logout</li>
</ul>
</div>

<div class="popup container-fluid">
<div class="popupprofile">
<table class="table table-striped">
    <thead class="theadc">
        <tr>
            <th scope="col" colspan="7">Profile</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="7" class="tablepic">
                <img class="profilepic" src="<?php echo $_SESSION['image']; ?>" alt="">
                <img src="images/picedit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">First Name</th>
            <td colspan="4"><?php echo $_SESSION['first_name']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Last Name</th>
            <td colspan="4"><?php echo $_SESSION['last_name']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Email</th>
            <td colspan="4"><?php echo $_SESSION['email']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Username</th>
            <td colspan="4"><?php echo $_SESSION['username']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Gender</th>
            <td colspan="4"><?php echo $_SESSION['gender']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Phone</th>
            <td colspan="4"><?php echo $_SESSION['phone']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Address</th>
            <td colspan="4"><?php echo $_SESSION['address']; ?></td>
            <td colspan="1">
                <img src="images/edit.png" alt="">
            </td>
        </tr>
    </tbody>
</table>
<button type="button" class="btn btn-outline-primary profileclose">Close</button>
</div>
<div class="popuphistory">
<h3>Attendance Report for
    <b><?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"] ?></b>
</h3>
<table class="table table-striped">
    <thead class="theadc">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Time In</th>
            <th scope="col">Time Out</th>
        </tr>
    </thead>
    <tbody class="appendtable">
        <!-- ajax input -->
    </tbody>
</table>
<button type="button" class="btn btn-outline-primary">Export to Excel Sheet</button>
<button type="button" class="btn btn-outline-primary historyclose">Close</button>

</div>
</div>
<div class="container-fluid main">

<div class="main row">
<div class="col-sm-4">
</div>
<div class="col-sm-4 middle">
    <img src="<?php echo $_SESSION['image']; ?>" alt="">
    <h2><?php echo $_SESSION["first_name"]." ".$_SESSION["last_name"] ?></h2>
    
    <div class="checkcontainer">
    <form action="" method="post">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1" <?php echo $checkinstatus; ?>>
            <label class="custom-control-label" for="customCheck1">Check In</label>
        </div>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheckDisabled" <?php echo $checkoutstatus; ?>>
            <label class="custom-control-label" for="customCheckDisabled">Check Out</label>
        </div>
        </form>
    </div>
    <h3><span id="hrs">00</span>:<span id="min">10</span>:<span id="sec">59</span> <span id="ampm">AM</span></h3>
    <h3 id="Date">08:10:59 AM</h3>


    <!-- <div class="image">
<img src="images/olotusquare.jpg"/>
</div> -->
</div>
<div class="col-sm-4">
</div>

</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
crossorigin="anonymous"></script>
<script src="css/bootstrap4.1/js/bootstrap.min.js"></script>
<script src="js/profile.js"></script>
</body>

</html>