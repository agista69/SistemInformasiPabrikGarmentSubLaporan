<?php

if (isset($_POST['login'])) {
    if ($_POST['id'] == 'as') {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $_POST['password'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login Manajer</h1>
    <form action="/karyawan/login" method="POST">
        id <br>
        <input type="text" name="id" id="id">
        password <br>
        <input type="text" name="password" id="password">
        <button type="submit" name="login">Masuk</button>
    </form>
</body>

</html>