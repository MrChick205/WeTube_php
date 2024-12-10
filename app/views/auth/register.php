<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/asset/register.css">
</head>
<body>
    <div class="container">
        <div class="signup-form">   
            <form action="" method="POST">
                <h2>Create your Free Account</h2>
                <div class="form">
                    <p>Full Name</p>
                    <input type="text" name="fullname" placeholder="Enter your Full Name here" required>
                </div>
                <div class="form">
                    <p>Email</p>
                    <input type="email" name="email" placeholder="Enter your Email here" required>
                </div>
                <div class="form">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter your Password here" required>
                </div>
                <button type="submit">Create Account</button>
            </form>
            <p class="login">Already have an account? <a href="#">Log in</a></p>
            <button id="google">Sign up with Google</button>
        </div>
    </div>
</body>
</html>