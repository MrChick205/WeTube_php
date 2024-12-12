<?php
    require_once 'C:\xampp\htdocs\WeTube_php\app\controllers\login.php';

    $logout = new LoginController($conn);
    
    $log_out = $logout->logout();
?>