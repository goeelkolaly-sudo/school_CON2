<?php
$connection = new PDO("mysql:host=localhost;dbname=test1", "root", "");

// لما الفورم يتبعت
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ❌ كود غير آمن (فيه ثغرة)
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $connection->query($query);

    if ($result && $result->rowCount() > 0) {
        echo "<h2 style='color:green'>Login success ✅</h2>";
    } else {
        echo "<h2 style='color:red'>Login failed ❌</h2>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection Test</title>
</head>
<body>

<h1>Login</h1>

<form method="POST">
    <input type="text" name="username" placeholder="username"><br><br>
    <input type="text" name="password" placeholder="password"><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>