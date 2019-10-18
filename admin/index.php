<?php
include_once('../includes/config.php');

if (!$_SESSION['id']) {
    header('Location: login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Rickard</title>



</head>
<body>
    <div>
        <h1>Du är inloggad</h1>
    </div>



    <script src="js/main.js"></script>
</body>
</html>