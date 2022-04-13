<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
        <a href="index.php">Home</a>
            <?php if(!isset($_SESSION['userId'])) : ?>
            <a href="signup.php"><li>Sign Up</li></a>
            <a href="login.php">Login</a>

            <?php else: ?>
                <a href="./controllers/User.php?q=logout"><li>Logout</li></a>
                <?php endif; ?>
            
        </ul>
    </nav>

    <h1>Welcome <?php if (isset($_SESSION['userId'])) {
        echo explode(" ", $_SESSION['userName'])[0];
    } else echo "Guest" ?></h1>
</body>
</html>