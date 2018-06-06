<?php
// $empty_first;
// $empty_last;
// $empty_user;
// $empty_pass;
// $empty_repass;
// $passmismatch;
// $empty_gender;
// $empty_email;
// $empty_phone;
// $empty_dob;
// $empty_address;
// $empty_pic;
$error = 0;
 if (!empty($_POST['first'])) {
    $first=trim($_POST["first"]);
 }else{
     $error = 1;
     $empty_first="* First Name required.";
 }
 if (!empty($_POST['last'])) {
    $last=trim($_POST["last"]);
 }else{
     $error = 1;
     $empty_last="* Last Name required.";
 }
 if (!empty($_POST['user'])) {
    $user=trim($_POST["user"]);
 }else{
     $error = 1;
     $empty_user="* Username required.";
 }
 if (!empty($_POST['pass'])) {
    $pass = password_hash(trim($_POST["pass"]).$_POST["dob"], PASSWORD_BCRYPT);
 }else{
     $error = 1;
     $empty_pass="* Password required.";
 }
 if (!empty($_POST['repass'])) {
    $pass = password_hash(trim($_POST["pass"]).$_POST["dob"], PASSWORD_BCRYPT);
 }else{
     $error = 1;
     $empty_repass = "* Password required.";
 }
 if($_POST["pass"] != $_POST["repass"]){
    $passmismatch = "* Password mismatch.";
    $error = 1;
}
 if (!empty($_POST['email'])) {
    $email = trim($_POST["email"]);
 }else{
     $error = 1;
     $empty_email = "* Email required.";
 }
 if (!empty($_POST['phone'])) {
    $phone = trim($_POST["phone"]);
 }else{
     $error = 1;
     $empty_phone = "* Phone number required.";
 }
 if (!empty($_POST['dob'])) {
    $dob = trim($_POST["dob"]);
 }else{
     $error = 1;
     $empty_dob = "* Date of Birth required.";
 }
 if (!empty($_POST['address'])) {
    $address = $_POST["address"];
 }else{
     $error = 1;
     $empty_address = "* Address required.";
 }
 if (isset($_POST['gender']) && !empty($_POST['gender'])) {
    $gender = trim($_POST["gender"]);
 }else{
     $error = 1;
     $empty_gender = "* Gender required.";
 }
 if (!empty($_FILES["profilepic"]["name"])) {
    
 }else{
     $error = 1;
     $empty_pic = "* Profile Picture required.";
 }
if($error == 0){
    
$first=$_POST["first"];
        $last=$_POST["last"];
        $user=$_POST["user"];
        $pass = password_hash($_POST["pass"].$_POST["dob"], PASSWORD_BCRYPT);
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $dob=$_POST["dob"];
        $address=$_POST["address"];
        $gender=$_POST["gender"];

 //check email and username already exists
include 'dbconnect.php';
try {
$data = $conn->prepare("SELECT username, email FROM personalInfo WHERE (username=:username OR email=:email)");
$data->bindParam(':username', $user);
$data->bindParam(':email', $email);
$data->execute();
if($data->rowCount() > 0){
    $error_empty = "Email or Username Already exists!";
} else{
    try {
        // prepare sql and bind parameters
        $data = $conn->prepare("INSERT INTO personalInfo(first_name, last_name, username, password, gender, email, phone, address, dob, image) 
        VALUES (:first, :last, :username, :password, :gender, :email, :phone, :address, :dob, :image)");
        $data->bindParam(':first', $first);
        $data->bindParam(':last', $last);
        $data->bindParam(':username', $user);
        $data->bindParam(':password', $pass);
        $data->bindParam(':gender', $gender);
        $data->bindParam(':email', $email);
        $data->bindParam(':phone', $phone);
        $data->bindParam(':address', $address);
        $data->bindParam(':dob', $dob);
        $data->bindParam(':image', $target_file);
        
        //execute query to insert into row
        $data->execute();
        move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file);
        }
    catch(PDOException $e)
        {
            $error_empty = "Error: " . $e->getMessage();
        }
}
}
catch(PDOException $e)
    {
        $error_empty = "Error: " . $e->getMessage();
    }
$conn = null;
}else{
    $error_empty = "Error! ";
}