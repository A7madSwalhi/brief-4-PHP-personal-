<?php 

session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";


var_dump($_SESSION['user_type']) ;