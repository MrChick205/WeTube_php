<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="../../../public/asset/register.css">
</head>
<body>
    <div class="container">
        <div class="signup-form">   
            <!-- Chỉnh sửa action để trỏ tới controller -->
            <form action="../../controllers/register.php" method="POST">
                <h2>Create your Free Account</h2>
                <div class="form">
                    <p>Full Name</p>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your Full Name here" required>
                </div>
                <div class="form">
                    <p>Email</p>
                    <input type="email" id="email" name="email" placeholder="Enter your Email here" required>
                </div>
                <div class="form">
                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Enter your Password here" required>
                </div>
                <button type="submit">Create Account</button>
            </form>
            <p class="login">Already have an account? <a href="#">Log in</a></p>
            
            <a href="login.php" class="social">
                <button id="google">
                    <i class="lni lni-google ggicon"></i>
                    Sign up with Google   
                </button>
            </a>
            
        </div>
    </div>
</body>
</html>
