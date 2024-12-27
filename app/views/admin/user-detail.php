<?php
require_once 'C:\xamppp\htdocs\Wetube\WeTube_php\app\controllers\user.php';

// Initialize the user controller
$Userctrll = new UserController($conn); // Make sure to replace UserController with the correct class name

// Get user_id from URL
if (isset($_GET['user_id'])) {
    $UserId = intval($_GET['user_id']);
    $User = $Userctrll->getUser($UserId);
    
    if (!$User) {
        die("User not found.");
    }
} else {
    die("User ID is required.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
  background-color: #181818; /* Dark background color */
  color: #fff; /* White text color */
  font-family: sans-serif;
}

.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 5px;
  background-color: #282828; /* Slightly lighter background for the container */
}

.profile-picture {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background-color: #383838; /* Darker background for the profile picture */
  margin-bottom: 20px;
}

.info {
  margin-bottom: 20px;
}

.info p {
  margin: 5px 0;
}

.recent {
  margin-bottom: 20px;
}

.recent-images {
  display: flex;
  flex-wrap: wrap;
}

.recent-images img {
  width: 100px;
  height: 140px;
  margin: 5px;
  border-radius: 5px;
}

.delete-btn {
  background-color: #f44336; /* Red color */
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-picture"></div>
        <div class="info">
            <p><strong>User name:</strong> <?php echo htmlspecialchars($User['user_name']); ?></p>
            <p><strong>Birth:</strong> <?php echo htmlspecialchars($User['birth']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($User['email']); ?></p>
        </div>
        <div class="recent">
            <p><strong>Recent:</strong></p>
            <div class="recent-images">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYxnnMqQyMqz_sWOc-HIaB8QJu9ZeGd0ijnA&s" alt="Recent item">
                <img src="https://m.media-amazon.com/images/I/61RhWaYBp7L._AC_UF894,1000_QL80_.jpg" alt="Recent item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRN-31qQugbrPeoBQKjJuXDURsAztkATje7BQ&s" alt="Recent item">
                <img src="https://m.media-amazon.com/images/I/71lADxngTWS._AC_SL1050_.jpg" alt="Recent item">
            </div>
        </div>
        <button class="delete-btn">Delete user</button>
    </div>
</body>
</html>