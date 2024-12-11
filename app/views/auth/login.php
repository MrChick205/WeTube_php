<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: black;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 60%;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin: 100px auto;
        }

        h1 {
            margin-bottom: 20px;
        }

        .form-login {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        label {
            margin-top: 20px;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            background-color: azure;
            width: 95%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: yellow;
            color: black;
            padding: 10px 15px;
            width: 100px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            align-self: center;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: rgb(188, 188, 0);
        }

        p {
            margin-top: 20px;
        }

        p a {
            text-decoration: none;
            color: yellow;
        }

        .google-button {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: 1px solid black;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .google-button img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .forgot-pw {
            margin-top: 5px;
            color: black;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" class="form-login" action="">
            <label for="user-email">Email</label>
            <input type="text" name="user-email" id="user-email" placeholder="Input your email here">

            <label for="user-password">Password</label>
            <input type="password" name="user-password" id="user-password" placeholder="Input your password here">

            <input type="submit" value="Login">
        </form>
        <a href="" class="forgot-pw">Forgot Password?</a>
        <p>Already have an account? <a href=""><b>Register</b></a></p>
        <button class="google-button">
            <img src="https://storage.googleapis.com/libraries-lib-production/images/GoogleLogo-canvas-404-300px.original.png"
                alt="google">
            Sign up with Google
        </button>
    </div>
</body>

</html>