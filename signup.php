<?php
 include_once "./helpers/session_helper.php";
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
    <h1>Register</h1>
    <?php flash('register') ?>
    <form action="./controllers/Users.php" method="post">
        <input type="hidden" name="type" value="register">    <!-- De phan biet post request nay voi cac post request khac -->
        <input type="text" name="userName" placeholder="Fulname...">
        <input type="email" name="userEmail" placeholder="Email...">
        <input type="text" name="userUid" placeholder="User Name...">
        <input type="password" name="userPwd" placeholder="Password...">
        <input type="password" name="pwdRepeat" placeholder="Repeat Password...">
        
    </form>
</body>
</html>