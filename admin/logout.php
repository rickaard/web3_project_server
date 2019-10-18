<?php

include_once('../includes/config.php');

// Remove the saved session-variable
session_destroy();
session_unset();
unset($_SESSION['id']);

// Redirect to admin startpage (if not logged in, that will be login.php)
header("Location: index.php");

?>