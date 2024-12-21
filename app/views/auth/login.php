<?php
session_start();
require_once '../../controllers/login.php';


$loginController = new LoginController($conn);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = $loginController->login();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../../public/asset/login.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" class="form-login" action="">
            <label for="user-email">Email</label>
            <input type="text" name="email" id="email" placeholder="Input your email here" required>

            <label for="user-password">Password</label>
            <input type="password" name="password" id="password" placeholder="Input your password here" required>

            <input type="submit" value="Login">
        </form>
        <a href="#" class="forgot-pw">Forgot Password?</a>
        <p>Already have an account? <a href="register.php"><b>Register</b></a></p>
        <button class="google-button" onclick="alert('Google sign-in not implemented')">
            <img src="https://storage.googleapis.com/libraries-lib-production/images/GoogleLogo-canvas-404-300px.original.png" alt="google">
            Sign up with Google
        </button>
    </div>
</body>

</html>