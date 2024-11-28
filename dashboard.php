<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <h2>Welcome, " . $_SESSION['username'] . "!</h2>";

if ($_SESSION['role'] == 'admin') {
    echo "<h3>You have admin privileges.</h3>";
    echo "<h3>List of Registered Users:</h3>";
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>";

    include 'config.php';
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["role"] . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    echo "</table>";
    $conn->close();
} else {
    echo "<h3>You are a regular user.</h3>";
}

echo "<a href='logout.php' class='logout-btn'>Logout</a>
</body>
</html>";
?>
