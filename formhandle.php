<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//for login
if(isset($_POST["loginsubmit"])){
    if (!empty($_POST['username']) && !empty($_POST['password'])){
         //check email and username already exists
include 'dbconnect.php';
try {
$data = $conn->prepare("SELECT * FROM personalInfo WHERE (username=:username OR email=:username)");
$data->bindParam(':username', $_POST['username']);
$data->execute();
$result = $data->fetch(PDO::FETCH_ASSOC);
$conn = null;
if(password_verify($_POST['password'].$result["dob"], $result["password"])) {
    session_start();
    $_SESSION["id"] = $result["id"];
    $_SESSION["first_name"] = $result["first_name"];
    $_SESSION["last_name"] = $result["last_name"];
    $_SESSION["username"] = $result["username"];
    $_SESSION["gender"] = $result["gender"];
    $_SESSION["email"] = $result["email"];
    $_SESSION["phone"] = $result["phone"];
    $_SESSION["address"] = $result["address"];
    $_SESSION["dob"] = $result["dob"];
    $_SESSION["image"] = $result["image"];

    header('Location: '.'profile.php');
    exit();
}else{
    $error_login = "* Wrong login details.";
}
}
catch(PDOException $e)
    {
        $error_empty = "Error: " . $e->getMessage();
    }
        // if(password_verify($password, $hashed_password)) {}


    }else{
        $error_login = "* All fields required.";
    }
}
//for Registration
if(isset($_POST["registersubmit"])){

        //upload image
        $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profilepic"]["tmp_name"]);
    if($check !== false) {
        // echo "<script>File is an image - " . $check["mime"] . ".</script>";
        $uploadOk = 1;
    } else {
        $empty_pic = "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    $empty_pic = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $empty_pic = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {
    include 'dbinsert.php';
// if everything is ok, try to upload file
}else{
    $error_empty = "Error! ";
}
}
}