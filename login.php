
<?php
session_start();
include "db_connect.php";
if(isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $hash = hash('sha512', $pass);
//    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => 10));
//    $auth = password_verify($_POST['password'], $hash);
//    echo $auth ;
//    echo $pass ;
    if (empty($username)) {
        header ("Location: index.php?erro-User Name is required");
        exit();
    }
    else if (empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}
}
else{
    exit();

}
$sql = "SELECT * FROM admins WHERE username='$username' AND password='$hash'";
$result = mysqli_query($conn, $sql);
echo ' tu e provu';
echo mysqli_num_rows($result);
if(mysqli_num_rows($result) === 1) {
    echo ' hyni1';

    $row = mysqli_fetch_assoc($result);
    if($row['username'] === $username && $row['password'] === $hash) {
        echo "Logged In!";
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['admin_id'];
        header("Location: dashboard.php");
        exit();
    }
    else{
        header("Location: index.php?error=Incorrect UserName or Password");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}