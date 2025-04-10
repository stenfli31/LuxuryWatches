<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./style/global.css" />
  <link rel="stylesheet" href="./style/style.css" />
  <link rel="stylesheet" href="./style/media.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<?php 
if(ini_get("session.use_cookies")){
    echo "<p class='ms-5'>cookie</p>";
}
else {
    echo "not cookie";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION=[];

    if(ini_get('session.use_cookies')){
        $params = session_get_cookie_params();
        setcookie(session_name(),'', time() - 42000, 
        $params["path"], $params["domain"],
         $params["secure"], $params["httponly"]);
}
session_destroy();
header("Location: index.php");
exit;
}


?>

<h1 class="text-center">Добро пожаловать, <?=$_SESSION['username'] ?>!</h1>
<div class="card col-4 mt-5 ms-2">
    <div class="car-body col-12">
        <div class="row mb-3"><span>Имя пользователя: </span> <?=$_SESSION['username'] ?></div>
        <div class="row"><span>email:</span> <?=$_SESSION['email'] ?></div>
    </div>
</div>
<form method="POST">
    <button type="submit" class="btn btn-danger">Выйти</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>