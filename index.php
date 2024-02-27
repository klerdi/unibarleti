
<!DOCTYPE html>
<html lang="en">
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" type="text/css" href="main.css"> </head>
<body>
<div class="center login">
    <div class="shape1"></div>
    <div class="shape2"></div>
<form action="login.php" method="post" class="glassCard pd2">
    <h2>LOGIN</h2>
    <?php if(isset($_GET['error'])) { ?>
        <p class="error"> <?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label for="username"> UserName</label>
    <input type="text" name="username" placeholder="User Name" id="username"><br>
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Password" id="password"><br>
    <button class="glassButton button" type="submit">Login</button>
</form>

</div>
</body>
</html>