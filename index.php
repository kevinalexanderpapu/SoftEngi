<!DOCTYPE html>
<html>
<head>
    <title>Login Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form id="loginForm" action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" id="loginBtn">Login</button>
    </form>
    <?php if(isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <p>Belum punya akun? 
        <a href="register.php">Daftar disini</a>
    </p>
</div>
</body>
</html>
