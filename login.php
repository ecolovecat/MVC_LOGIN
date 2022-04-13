<?php
    include_once "./helpers/session_helper.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>

    <?php flash("login") ?>

    <form method="post" action="./controllers/Users.php">
        <!--  -->
        <input type="hidden" name="type" value="login"> 
        <input type="text" name="name/email" placeholder="Username/Email...">
        <input type="password" name="userPwd" placeholder="Password...">
        <button type="submit">Login</button>
    </form>

    <div class="form-sub-msg"><a href="./reset-password.php">Forgotten Password?</a></div>




</body>
</html>