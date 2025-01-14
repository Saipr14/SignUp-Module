<?php
include('Config/db_config.php');
require('FormValidation.php');

if(($_SERVER['REQUEST_METHOD'] == 'GET')){
  // Fetch user details
  if (!isset($_GET['id'])) {
    header("Refresh: 5; URL=Home.php");
    die("Error: No ID provided. Redirecting in 5 seconds...");
  }
  
  if (isset($_GET['id'])) {
      $id = $_GET['id'];
  
    $stmt = $conn->prepare("SELECT * FROM signup_users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result && $result->num_rows > 0) {
        $datas = $result->fetch_assoc();
        $name_get = $datas['UName'];
        $email_get = $datas['Email'];
    } else {
        echo "No record found for ID: " . htmlspecialchars($id);
    }
  }
}

// Form Validation and Update
if(isset($_POST['update'])){
  $formval = new FormValidation($_POST);
  $errors = $formval->ValidateSignIn();

  $name_post = $_POST['name'];
  $email_post = $_POST['email'];
  $id_post = $_POST['Id_to_update'];
// Update record if no errors
if(empty($errors)){
  if (isset($_POST['Id_to_update'])) {
      $id = $_POST['Id_to_update'];
      $name = $_POST['name'];
      $email = $_POST['email'];

      $stmt = $conn->prepare("UPDATE signup_users SET UName=?, Email=? WHERE id=?");
      $stmt->bind_param("ssi", $name, $email, $id);

        if ($stmt->execute()) {
            header("Location: Home.php");
            exit;
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
  }
}
}

// Cancel and redirect to Home page
if (isset($_POST['cancel'])) {
  header("Location: Home.php");
  exit;
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign Up</title>
</head>
<body>

<div class="container-lg container-fluid container-xl container-xs align-middle" style=" min-height: 600px" id="contain">
    <!-- Navbar start -->
          <nav class="navbar bg-transparent">
            <div class="container-fluid">
              <a class="navbar-brand text-light fw-bold" href="#">
              Template<br>Design<br>
              </a>
              <div class=" justify-content-end" id="navbarNav">
                <ul class="navbar-nav ">
                  <li class="nav-item ms-4 d-md-inline">
                  <button type="button" class="btn btn-primary rounded-pill px-5 fs-6 fw-medium font-monoscope">SIGN UP</button>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
            
    <!-- Navbar end -->

<!-- Forms Start -->
<?php if ($datas??'' || $errors): ?>
<div class="row justify-content-center" style="height: 548px;"> 
<div class="col-md-8 col-xl-4" style="height: 548px;">
  <form id="updateform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="pt-5">

    <!-- User Avatar -->
      <div class="position-relative text-center">
        <img src="assets/user.png" class="user-img position-relative top-50 start-50 translate-middle" alt="user.png" width="140" height="120">
      </div>
    <!-- User Avatar -->

    <!-- Name Input -->
      <div class="input-group mb-4">
        <span class="input-group-text rounded-start-pill py-2 border-1 bg text-light">
          <i class="bi bi-envelope-at"></i>
        </span>
        <input 
          type="text" 
          name="name" 
          class="form-control rounded-end-pill py-2 bg text-light border-1" 
          placeholder="Name Here" 
          autocomplete="off" 
          value="<?php echo htmlspecialchars($name_get??$name_post); ?>"
        >
        <span id="red"><?php echo isset($errors['name']) ? htmlspecialchars($errors['name']) : ''; ?></span>
      </div>
      
    <!-- Name Input -->

    <!-- Email Input -->
      <div class="input-group mb-4">
        <span class="input-group-text rounded-start-pill py-2 bg text-light border-1">
          <i class="bi bi-lock"></i>
        </span>
        <input 
          type="email" 
          name="email" 
          class="form-control rounded-end-pill py-2 bg text-light border-1" 
          placeholder="Email Here" 
          autocomplete="off" 
          value="<?php echo htmlspecialchars($email_get??$email_post); ?>"
        >
        <span id="red"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?></span>
      </div>
      
    <!-- Email Input -->

    <!-- Action Buttons -->
      <div class="row align-items-center">
        <div class="col">
          <input type="submit" name="cancel" value="Cancel" class="btn cancel-btn rounded-pill mt-4 text-light">
        </div>
        <div class="col">
          <input type="hidden" name="Id_to_update" value="<?php echo htmlspecialchars($datas['id']??$id_post); ?>">
          <input type="submit" id="update" name="update" value="Update" class="btn smb-btn rounded-pill mt-4 btn-primary">
        </div>
        </div>
    <!-- Action Buttons -->

  </form>
</div>

  <!-- Side Wordings and Image Section -->
  <div class="col-md-2 col-xl-8 text-end shad d-none d-xl-inline" style="height: 548px; padding: 0;">
    <img src="assets/bg.png" id="bg-img" alt="wavy.png" width="600" height="325">
    <div class="text">
      <h2 class="fw-bold" style="font-size: 3rem;">Welcome Amigo.</h2><br>
      <p class="fw-light lh-0" style="font-size: 0.8rem; position: relative; left: 30%; width: 270px;">
        Let's update your unrelated (or) minded-to-change data? Whatever, amigos, update it... and then be a part of our community.
      </p>
      <p class="lh-0" style="font-size: 0.8rem;">
        Not an amigo? <a href="Signin.php" class="text-light" style="font-size: 0.8rem;"><b>Join Now</b></a>
      </p>
    </div>
  </div>
</div>


<?php else: ?>
<!-- No Data Found Section -->
  <div class="col-md-2 col-xl-8 text-end shad d-none d-xl-inline" style="height: 548px; padding: 0;">
    <img src="assets/bg.png" id="bg-img" alt="wavy.png" width="600" height="325">
    <div class="text">
      <h2 class="fw-bold" style="font-size: 3rem;">Sorry Amigo.</h2><br>
      <p class="fw-light lh-0" style="font-size: 0.8rem; position: relative; left: 30%; width: 270px;">
        You've got a 404 Error. We can't find any account with this ID! Make sure you have registered already and visit here with enthusiasm. Until then, just refresh and redirect.
      </p>
      <p class="lh-0" style="font-size: 0.8rem;">
        Not an amigo? <a href="Signin.php" class="text-light" style="font-size: 0.8rem;"><b>Join Now</b></a>
      </p>
    </div>
  </div>
<!-- No Data Found Section -->
<?php endif; ?>

<!-- <div id="dialog-confirm" title="Form Validation Errors" style="display:none;">
    <p>There are errors in your form submission. Please correct them before proceeding.</p>
</div> -->


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

 @media only screen and (max-width: 365px) {
  
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
}

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
  padding: 5px 60px;
}

.cancel-btn{
  color: transparent;
  border: aliceblue 1px solid;
  padding: 5px 60px;
}

.cancel-btn:hover{
  border: lightblue 1px solid;
  color:rgb(135, 123, 205);
  padding: 5px 60px;
}

.smb-btn:hover{
  background-color:rgb(148, 41, 130);
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


input[type=password]:focus {background-color: transparent;}
input[type=text]:focus {background-color: transparent; }
input[type=email]:focus {background-color: transparent; }

.form-control:focus{
  box-shadow: none;
}


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

<script>
// $(document).ready(function () {
//     $('#update').on('click', function (e) {
//         // Fetch the PHP-generated errors array as JSON
//         var errors = <?php //echo json_encode($errors ?? []); ?>;

//         // Check if there are errors
//         if (Object.keys(errors).length === 0) {
//             // If no errors, allow form submission
//             return true;
//         } else {
//             // Prevent form submission and show dialog
//             e.preventDefault();

//             // Display a confirmation dialog
//             $("#dialog-confirm").dialog({
//                 resizable: false,
//                 height: "auto",
//                 width: 400,
//                 modal: true,
//                 buttons: {
//                     "Proceed": function () {
//                         $(this).dialog("close");
//                         $('#updateform').submit();
//                     },
//                     "Cancel": function () {
//                         $(this).dialog("close");
//                     }
//                 }
//             });
//         }
//     });
// });
</script>

</body>
</html>