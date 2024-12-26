<?php
// Giả sử bạn đã khởi tạo đối tượng UserModel và kết nối cơ sở dữ liệu
require_once '../../controllers/user.php';

$user = new UserController($conn);
$users = $user->getAllUsers(); // Lấy danh sách người dùng
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }
        h2 {
            margin-bottom: 20px;
            color: #ffffff;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }
        th, td {
            border: 1px solid #555;
            text-align: center;
            padding: 12px;
            font-size: 16px;
        }
        th {
            background-color: #444;
            color: #f1f1f1;
        }
        td {
            background-color: #2c2c2c;
        }
        tr:nth-child(even) td {
            background-color: #3a3a3a;
        }
        tr:hover td {
            background-color: #505050;
            transition: background-color 0.3s ease;
        }
        .action-button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 14px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .action-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h2>User List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Birth</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['birth']); ?></td>
                        <td><a href="your-link-here" class="action-button">Detail</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>