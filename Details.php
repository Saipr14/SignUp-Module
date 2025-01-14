<?php
include('Config/db_config.php');

if(isset($_POST['Id_to_delete'])){
    $id = mysqli_escape_string($conn,$_POST['Id_to_delete']);

    $sql = "DELETE FROM signup_users WHERE id=$id";

    if(mysqli_query($conn,$sql)){
        header("location:Home.php");
    }
    else{
        echo "There is an error in deleting: " .mysqli_error($conn);
        header("Home.php");
    }
}

if(isset($_GET['id'])){
    // Assign id to a variable 
    $id = mysqli_real_escape_string($conn,$_GET['id']);

    // Creating query
    $sql = "SELECT * FROM signup_users WHERE id=$id";
if($sql){
    // Executing the query
    $result = mysqli_query($conn,$sql);

    // Store in an associative array
    $datas = mysqli_fetch_assoc($result);
}
else{
    echo "Invalid query" . mysqli_error($conn);
}
    // Closing and Freeing
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="GeneralCss.css">
    <title>Home\Details</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" ></script>
</head>
<body>
<?php include('Header.php') ?>
    <div class="container  d-flex justify-content-center mt-5">
    <?php if($datas): ?>
    <div class="card text-center px-2 py-2 m-0 mb-2" style="width: 20rem;">
                    <img src="assets/user.png" class="card-img-top img-fluid" alt="UserImage" width="46" height="107">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($datas['UName'])?></h5>
                        <div class="card-subtitle"><?php echo htmlspecialchars($datas['Email']) ?></div>
                        <div class="card-text">Your Id no.: <?php echo htmlspecialchars($datas['id']) ?></div>
                    </div>
                    <div class="card-body  align-items-center">
 
                            <form id="deleteform" action="Details.php" method="POST">
                                <input type="hidden" name="Id_to_delete" value="<?php echo htmlspecialchars($datas['id'])?>">
                                <input type="submit" Id="delete" value="Delete Account" class="btn btn-primary ">
                            </form>
                            </div>
                     </div>
                    </div>

<?php else: ?>
    <p>The Profile with this Id doesn't exist</p>
<?php endif ?>

<style>
/* :root{
    color-scheme: light dark;
} */
body{
    margin: 0;
    background-color: light-dark(#eee,#21242b);
    color: light-dark(#21242b,#eee);
}
</style>  

<script>
    $(document).ready(function () {
    $('#delete').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        if (confirm('Are you sure you want to delete this item?')) {
            // If the user confirms, submit the form
            $('#deleteform').submit();
            alert("Deleted successfully.....");
        }
    });
});
</script>
</body>
</html>