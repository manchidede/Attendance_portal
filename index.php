<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: profile.php"); 
exit();
  }


include 'formhandle.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <title>Document</title>
</head>
<body>
        <div class="navbar">
                <h2>Attendance Portal</h2>
            </div>
    <div class="main container-fluid">
        <div class="first">
            <div class="loginreg">
                <div class="navlogreg" id="navlogreg">
                    <div class="navlog active">
                        Login
                    </div>
                    <div class="navlog reg">
                        Register
                    </div>
                </div>
                <div class="login">
                    <form action="" method="post">
                    <span class="error"><?php echo $error_login; ?></span><br>
                        <input type="text" placeholder="Username" name="username"><br>
                        <input type="password" placeholder="Password" name="password"><br>
                        <!-- <input type="submit" value="Login" name="loginsubmit"> -->
                        <button type="submit" class="btn btn-primary" name="loginsubmit">Submit</button>
                    </form>
                </div>
                <div class="register">
  <form action="" method="post" enctype="multipart/form-data">
  <span class="error"><?php echo $error_empty; ?></span>
  <span class="error"><?php echo $empty_first; ?></span>
          <div class="form-group row">
                  <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
                  <div class="col-sm-9">
                    <input name="first" type="text" class="form-control" id="firstName" placeholder="First name">
                  </div>
                </div>
                <span class="error"><?php echo $empty_last; ?></span>
          <div class="form-group row">
            <label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
            <div class="col-sm-9">
              <input type="text" name="last" class="form-control" id="lastName" placeholder="Last Name">
            </div>
          </div>
          <span class="error"><?php echo $empty_user; ?></span>
          <div class="form-group row">
                  <label for="username" class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" name="user" class="form-control" id="username" placeholder="Username">
                  </div>
                </div>
                <span class="error"><?php echo $empty_pass; ?></span>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password">
            </div>
          </div>
          <span class="error"><?php echo $empty_repass; ?></span>
          <span class="error"><?php echo $passmismatch; ?></span>
          <div class="form-group row">
                  <label for="inputPasswordconfirm" class="col-sm-3 col-form-label">Re-Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="repass" class="form-control" id="inputPasswordconfirm" placeholder="Re-Password">
                  </div>
                </div>
                <span class="error"><?php echo $empty_gender; ?></span>
          <div class="form-group row">
                  <label for="inlineRadio1" class="col-sm-3 col-form-label">Gender </label>
                  <div class="col-sm-9">
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                </div>
              </div>
              <span class="error"><?php echo $empty_email; ?></span>
              <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" placeholder="example@olotu.co">
                      </div>
                    </div>
                    <span class="error"><?php echo $empty_phone; ?></span>
                    <div class="form-group row">
                          <label for="Email" class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" placeholder="080...">
                          </div>
                        </div>
                        <span class="error"><?php echo $empty_dob; ?></span>
                        <div class="form-group row">
                              <label for="Email" class="col-sm-3 col-form-label">Date of Birth</label>
                              <div class="col-sm-9">
                                <input type="text" name="dob" class="form-control" placeholder="yyyy-mm-dd">
                              </div>
                            </div>
                            <span class="error"><?php echo $empty_address; ?></span>
                            <div class="form-group row">
                                  <label for="Address" class="col-sm-3 col-form-label">Address</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="Address" placeholder="Address">
                                  </div>
                                </div>
                                <span class="error"><?php echo $empty_pic; ?></span>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="profilepic" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Profile Image</label>
                          </div>
                        </div>


                                <button type="submit" class="btn btn-primary" name="registersubmit">Submit</button>
        </form>
                </div>
            </div>
        </div>
        <div class="second">
            <div class="image">
                    <img src="images/olotusquare.jpg"/>
            </div>
        </div>
        
    </div>
    <!-- <div class="footer container-fluid">
            <h2>Attendance Portal</h2>
        </div> -->

    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="css/bootstrap4.1/js/bootstrap.min.js"></script>
    <script src="js/javascript.js"></script>
</body>
</html>