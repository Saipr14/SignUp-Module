<?php

$conn = mysqli_connect('localhost','Saipr14','Logan$6141','lostlogin');

if(!$conn){
    echo("Error connecting".mysqli_connect_error());
}

?>
<head>
<link rel="icon" href="assets/logoTD.png" type="image/png">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" ></script>
<script src="control.js"></script>
</head>