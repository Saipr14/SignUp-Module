<?php 
include('Config/db_config.php');
// query we need to execute  
$query = "SELECT UName,Email,id FROM signup_users ORDER BY id";
// Execution of query
$res = mysqli_query($conn,$query);
// Arranging the data into assosciative array form
$dataasos = mysqli_fetch_all($res,MYSQLI_ASSOC);
// Printing all the value of array using printr
// print_r($dataasos);
// Freeup data space and closing connection(Optional but a good practice)
mysqli_free_result($res);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GeneralCss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
<!-- Header starts here -->
    
    <?php include('Header.php') ?>

<!-- Header ends here -->
 <div class="background">
<div class="container-xxl">
   <div class="display-3">
     <h4 class="text-center text-secondary-emphasis pt-4">Users SignedUp!</h4>
   </div>
      <div class="row justify-content-md-center">
        <!-- Card starts here -->
        <?php foreach($dataasos as $data): ?> 
          <div class="col-md-4 pt-4 d-lg-inline d-grid justify-content-center">
              <div class="card px-2 bg" style="width: 18rem; position:relative; left: 7%;">
                    <img src="assets/user.png" class="card-img-top img-fluid" alt="UserImage" width="46" height="107">
                    <div class="card-body">
                        <h5 class="card-title">Welcome, </h5>
                        <div class="card-subtitle"><?php echo htmlspecialchars($data['UName']) ?></div>
                    </div>
                <div class="row my-3">
                    <div class="col">
                        <a href="Details.php?id=<?php echo htmlspecialchars($data['id'])?>" class="btn btn-primary d-inline d-grid">More Details</a>
                    </div>
                    <div class="col">
                                <a  href="Update.php?id=<?php echo htmlspecialchars($data['id'])?>" class="btn btn-primary d-inline d-grid">Update</a>
                            </div>
                            </div>
              </div>
            </div>
        <?php endforeach;?>  
      <!-- Card ends here -->
      </div>
</div>
</div>
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


.navbar{
    height: 74px;
}

.navbar ul li{
    float: right;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>