<?php
    require_once 'C:\xamppp\htdocs\Wetube\WeTube_php\app\controllers\login.php';

    $logout = new LoginController($conn);
    
    $log_out = $logout->logout();
?>