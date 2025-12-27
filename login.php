<?php
require 'api/db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $q=$conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    if($q->num_rows){
        $_SESSION['user']=$q->fetch_assoc();
        header("Location:index.php");
    } else $err="Invalid login";
}
?>
<html>
<body>
<h2>GearGuard Login</h2>
<form method="POST">
<input name="email" placeholder="Email" required><br><br>
<input name="password" placeholder="Password" required><br><br>
<button>Login</button>
</form>
<?= $err ?? '' ?>
</body>
</html>
