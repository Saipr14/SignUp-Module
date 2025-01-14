<?php
// Including database connection strings
include('Config/db_config.php');
require('FormValidation.php');

// If clause to check the form is submitted or not
if(isset($_POST['submit'])){
    $fv = new FormValidation($_POST);
    $errors = $fv->ValidateSignUp();

// checking there is no errors/All fields are entered
  if(empty($errors)){
    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);

    $sql = "INSERT INTO signup_users(UName,Email,pass) VALUES('$name','$email','$pass')";
// Checking if insertion is done properly
    if(mysqli_query($conn,$sql)){
      // Its time to redirect
      // With a session and cookie
    // setcookie($gender,$_POST['gender'],time()+86400);
          if(isset($_POST['Remember'])){
            session_start();

            $_SESSION['name'] = $name;
           }
           else{
            session_start();
            $_SESSION['name'] = 'Guest';
           }
      header("location:Home.php");
    }
    else{
      echo 'Query Error: ' .mysqli_error($conn);
    }
    
  }
}

mysqli_close($conn);
?>
<!-- php ends here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GeneralCss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign Up</title>
</head>
<body>

    <div class="container-lg container-fluid container-xl container-xs align-middle" id="contain">
<!-- Navbar start -->
<nav class="navbar bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand text-light fw-bold" href="#">
        Template<br>Design<br>
      </a>
      <div class=" justify-content-end" id="navbarNav">
        <ul class="navbar-nav ">
          <!-- <li class="nav-item ms-4 list">
            <a class="nav-link text-light fw-bold" style="cursor:pointer;" href="Home.php">Home</a>
          </li> -->
          <li class="nav-item ms-4 d-md-inline">
            <a href="Signin.php"> <button type="button" class="btn btn-primary rounded-pill px-5 fs-6 fw-medium font-monoscope">SIGN IN</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
        
<!-- Navbar end -->

<!-- Forms Start -->
<div class="row justify-content-center "style="height: 548px;"> 
  <div class="col-md-8 col-xl-4" style="height: 548px;">
      <form id="form" action="index.php" method="post" class=" pt-5">
        <div class="position-relative">
          <img src="assets\user.png" class="user-img position-relative top-50 start-50 translate-middle" alt="user.png" width="140" height="120">
    <!-- Form Elements here -->
          <div class="input-group  mb-4 myown">
              <div class="input-group-text py-2 rounded-start-pill text-light bg border-1" id="inputGroup-sizing-sm"><i class="bi bi-person"></i></div>
              <input type="text" name="name" class="form-control py-2 border-top-right-radius-none rounded-end-pill text-light bg border-1" aria-label="Sizing example input" placeholder="Name Here" aria-describedby="inputGroup-sizing-sm" autocomplete="off" value="<?php echo htmlspecialchars($_POST['name'] ??'');?>"><br>
              <span id="red"><?php echo isset($errors['name']) ? htmlspecialchars($errors['name']) : ''; ?></span>
            </div>

        <div class="input-group  mb-4 myown">
            <span class="input-group-text rounded-start-pill py-2 border-1 bg text-light" id="inputGroup-sizing-sm"><i class="bi bi-envelope-at"></i></span>
            <input type="email" name="email" class="form-control rounded-end-pill py-2 bg text-light border-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Email Here"  autocomplete="off" value="<?php echo htmlspecialchars($_POST['email']??'');?>"><br>
            <span id="red"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?></span>
          </div>

        <div class="input-group  mb-4 myown">
            <span class="input-group-text rounded-start-pill text-light py-2 text-light bg border-1" id="inputGroup-sizing-sm"><i class="bi bi-lock"></i></span>
            <input type="password" name="pass" class="form-control rounded-end-pill py-2 text-light bg border-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Password Here"  autocomplete="off"><br>
            <span id="red"><?php echo isset($errors['pass']) ? htmlspecialchars($errors['pass']) : ''; ?></span>
          </div>

        <div class="input-group  mb-4 myown">
            <span class="input-group-text rounded-start-pill text-light py-2 text-light bg border-1 " id="inputGroup-sizing-sm"><i class="bi bi-shield-lock"></i></span>
            <input type="password" name="confpass" class="form-control rounded-end-pill py-2 text-light bg border-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Check Password"  autocomplete="off"><br>
            <span id="red"><?php echo isset($errors['confpass']) ? htmlspecialchars($errors['confpass']) : ''; ?></span>
          </div>

        <button type="submit" name="submit" class="btn smb-btn rounded-pill mt-4 position-relative translate-middle" style="position: relative; left:40%;">Submit</button>
    <!-- Form Elements here -->    
        <div class="container-fluid my-4  form-check ">
      <div class="row">
        <div class="col">
            <input type="checkbox" class="form-check-input rounded-4" name="Remember" style="background-color: #eb1dc5;" id="sumbit">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <div class="col">
             <a href="#" class="small display-9 fst-italic text-decoration-none text-light ">forgot password?</a>
        </div>
      </div>
    </div>
         </div>
    </form>
</div>
<!--Form Ends Here  -->

<!-- Side Wordings and Image Section -->
            <div class="col-md-2 col-xl-8 text-end shad d-none d-xl-inline" style="height: 548px; padding:0;">
                <img src="assets\bg.png" id="bg-img" alt="wavy.png" width="600" height="325" >
                <div class="text">
                  <h2 class="fw-bold"  style="font-size: 3rem;">Welcome Amigo.</h2><br>
                <p class=" fw-light lh-0" style="font-size: 0.8rem; position: relative; left: 30%; width: 270px;">Lorem ipsum dolor sit amet consectetur adipisicing elit.Eius provident iusto delectus sequi rerum nisi fuga commodi culpa esse veritatis.</p>
                 <p class=" lh-0" style="font-size: 0.8rem;">Already an amigo?<a href="Signin.php" class="text-light" style="font-size: 0.8rem;">Enter Now</a></p>
              </div>
            </div>
<!-- Side Wordings and Image Section -->
        </div>
    </div>
<!-- </section> -->
<style>
    body{
        background-color: #6e72fc;
        background-image:linear-gradient(224deg,#6E72EF,#ad1deb);
        background-repeat:no-repeat;
        min-height: 100vh;
        max-width:100%;
        color: white;
        font: 'Helvetica Neue', Helvetica, Arial, sans-serif;

      }

    .bg{   
      background-color: transparent;
    }


    nav ul li .list a:hover{
      padding: 0;
      background-color:#eb1dc5;
      border-radius: 5px;
      transition:all .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
    }


    #contain{
      background-color: #271f52;
      margin-top: 14px;
      border-radius: 24px;
    }

    /* @media only screen and (max-width: 1080px) {
      
    #contain{
      background-color: #271f52;
      padding-left: 20px;
      padding-right: 20px;
    }

    nav ul li:hover{
      padding: 0;
      background-color:#343232f0;
      border-radius: 5px 10px 10px 5px;
      transition:all .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
    }

    .nav-link{
      padding-left: 10px;
    }
    } */

    @media only screen and (max-width: 365px) {
      /* #contain {
        padding-left:10% ;
        padding-right: 10% ;
        padding-top: 1px;
        position: relative;
        top: 3%;
      } */

      body{
        line-height: 0%;
      }

      .input-group{
        position: relative;
        left: 13%;
      }

      form{
        position: relative;
        left: 50%;
      }

    }


    .shad{
      -webkit-box-shadow: -79px 8px 110px -100px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: -79px 8px 110px -100px rgba(0, 0, 0, 0.75);
    box-shadow: -79px 8px 110px -100px rgba(0, 0, 0, 0.75);
    }

    .navbar-toggler-icon{
      color: white;
    }

    #username,#password{
        background-color: #271f52;
    }

    .smb-btn{
      background-color: #eb1dc5;
      padding: 5px 93px;
    }

    .smb-btn:hover{
      background-color: #eb1dc7;
    }

    #red{
      color: #3fff3f;
      font-size: 12px;
      margin: 0%;
      padding: 0%;
      position: absolute;
      bottom: -20px;
      left: 20px;
    }

    .input-group input::placeholder {
      color: aliceblue;
      opacity: 0.5;
    }

    /* ::-ms-input-placeholder { 
      color: aliceblue;
    } */

    input[type=password]:focus {background-color: transparent;}
    input[type=text]:focus {background-color: transparent; }
    input[type=email]:focus {background-color: transparent; }

    .form-control:focus{
      box-shadow: none;
    }

    /* 

    input[type=name]:hover {border: solid 1px #eb1dc5; }
    input[type=email]:hover {border: solid 1px #eb1dc5; }
    input[type=pass]:hover {border: solid 1px #eb1dc5;}
    input[type=confpass]:hover {border: solid 1px #eb1dc5; } */

    #bg-img{
      transform: rotateX(180deg);
      position: relative;
      top: -4%;
      height: 324px;
      box-sizing: border-box;
      min-width: 100%;
    }

    .text{
      box-sizing: border-box;
      position: absolute;
      top: 39%;
      left: 65%;
    }

    .input-group{
      width: 87%;
      position: relative;
      left: 3%;
    }

    button[type=sumbit]{
      position: relative;
      left: 13%;
    }

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
