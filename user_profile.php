<?php

session_start();

include "connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql1 = "SELECT * FROM user WHERE email='$email' and `password`='$password'";
    $result1 = $conn->query($sql1);


    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['address'] = $row['address'];

        header("Location: user_profiles.php");
        exit();
    }
    
     else {
        echo "Invalid email or password";
    }
}


$conn->close();
?>

<!-- HTML for user_home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            transition: color 0.3s ease;
        }
        .navbar a:hover {
            color: #ffd700; 
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .user-details {
            text-align: center;
            margin-top: 20px;
        }
        .user-details h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .user-details p {
            font-size: 1.1em;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="navbar">
    
        <i class='bx bx-user'></i><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
        <a href="user_home.php"><i class='bx bx-home' ></i> Home</a>
        <a href="user_home.php">Profile</a>
        <a href="search_blood.php">Search Blood</a><!-- <a href="#">History</a>
        <a href="#">My Order</a> -->
        <a href="donates.php">Donate</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php">Log Out <i class='bx bx-log-out'></i></a>
    </div>
    <div class="container">
        <div class="user-details">
            <h2>Welcome, <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>!</h2>
            <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
            <p>Name: <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <p>Phone Number: <?php echo $_SESSION['phone_number']; ?></p>
            <p>Address: <?php echo $_SESSION['address']; ?></p>
            
    </div>
</body>
</html>
