<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
<?php
session_start();
if ( isset( $_SESSION[ 'loginError' ] ) )
    echo '<div class="error"> ' . $_SESSION[ 'loginError' ] . '</div><br />';
unset( $_SESSION[ 'loginError' ] );
?>
<form action="register.php" method="POST">
    <input type="text" name="name" placeholder="name">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="Register User"/>
</form>
</body>
</html>