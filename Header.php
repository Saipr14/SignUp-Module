<?php
      session_start();

      if($_SERVER['QUERY_STRING']=='noname'){
        unset($_SESSION['name']);
      }
     $name = $_SESSION['name'] ?? " " ;
    //  $gender = $_SESSION['gender'] ?? " ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="assets/logoTD.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" ></script>
</head>
<body>
<nav class="navbar navbar-expand-md border-bottom back">
    <div class="container-fluid">
      <a class="navbar-brand text-dark fw-bold" href="#">
        Template<br>Design<br>
      </a>
      <div class=" justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ms-4">
           <?php echo htmlspecialchars($name); ?>
          </li>
          <li class="nav-item ms-4 d-md-inline">
            <a href="Signin.php"> <button type="button" class="btn btn-primary rounded-pill px-5 fs-6 fw-medium font-monoscope buthead">SIGN IN</button></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</body>

<style>
  .back{
    background: rgba( 255, 255, 255, 0.2 );
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 7px );
    -webkit-backdrop-filter: blur( 7px );
    border-radius: 1px;
    border: 0.1px solid rgba( 255, 255, 255, 0.18 );
  }
</style>
</html>