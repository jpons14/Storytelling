<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<h1>Login</h1>
<form action="login.php" method="POST">
    <?php
        session_start();
        if (isset($_SESSION['loginError']))
            echo '<div class="error"> ' . $_SESSION['loginError'] . '</div><br />';
        unset($_SESSION['loginError']);
    ?>
    <label for="email">Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="email" id="email" name="email" placeholder="email"/>

    <br />

    <label for="password">Password</label>
    <input type="password" id="password" placeholder="Password" name="password"/>
    <br />
    <input type="submit" value="Login"/>
</form>
<a href="/registerForm.php">Register</a>
</body>
</html>