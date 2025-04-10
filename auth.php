<!DOCTYPE html>

<?php 
session_start();
echo $_SESSION['username'] . ' ' . $_SESSION['user_status'];
if(isset($_SESSION['username'])){
  header("Location: personalAccount.php");
}
require_once("db.php"); ?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/global.css" />
    <link rel="stylesheet" href="./style/style.css" />

    <link rel="stylesheet" href="./style/media.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php 


// Обработка регистрации
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = 2;

    // Проверка на существование email
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['error_message'] = "Пользователь с таким email уже существует!";
        header('Location: auth.php');
        exit;
    }


    // Вставка в базу данных
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, user_status) VALUES(?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $password, $status])) {
        $_SESSION['success_message'] = "Регистрация прошла успешно! Пожалуйста, войдите.";
        header('Location: auth.php');
        exit;
    } else {
        $_SESSION['error_message'] = "Ошибка при регистрации.";
        header('Location: auth.php');
        exit;
        
    }
}

// Обработка входа
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка на существование пользователя с таким email
    $stmt = $pdo->prepare("SELECT id, username, email, password, user_status FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Создание сессии для пользователя
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_status'] = $user['user_status'];
        $_SESSION['email'] = $user['email'];

        header('Location: index.php'); // Перенаправление на главную страницу или панель пользователя
        exit;
    } else {
        $_SESSION['error_message'] = "Неверный email или пароль!";
        header('Location: auth.php');
        exit;
    }
}

?>

 

<style>
     .card-header-tabs, .nav-link.active{
  border-bottom: 2px solid white;
  background-color: #e9ecef;
}

.nav-tabs{
    border-bottom: none !important;
}

.tab-pane{
  padding-top: 1rem;
}

.card-header{
    background-color: white !important;
    border: none !important ; 
}

.border-body{
    border: 1px solid #e1e1e1;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
    margin-top: 0px !important;
}

.nav-item{
    border-bottom: white;
    margin-bottom: 0px;
}

.nav-item:hover{
    border-bottom: white !important;
}

</style>

<?php 
if(!empty($message)): ?>

<div class="alert alert-info"><?= $message ?></div>
<?endif;?>

<?php if (!empty($_SESSION['error_message'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
    <?php endif; ?>

<div class="auth">
    <div class="container mt-5 col-4 ">
  <ul class="nav nav-tabs  ms-5" id="authTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Вход</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab"  >Регистрация</button>
    </li>
  </ul>

  <div class="tab-content mt-3 border-body d-flex justify-content-center">
    <!-- Вход -->
    <div class="tab-pane fade show active col-10" id="login" role="tabpanel">
      <form method="post" action="auth.php" class="d-flex flex-column">
        <div class="mb-3">
          <label for="loginEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="loginEmail" name="email" required>
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="loginPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary align-self-end me-1 mb-3" name="login">Войти</button>
      </form>
    </div>

    <!-- Регистрация -->
    <div class="tab-pane fade col-10" id="register" role="tabpanel">
      <form method="post" action="auth.php" class="d-flex flex-column ">
        <div class="mb-3">
          <label for="registerName" class="form-label">Имя</label>
          <input type="text" class="form-control" id="registerName" name="name" required>
        </div>
        <div class="mb-3">
          <label for="registerEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="registerEmail" name="email" required>
        </div>
        <div class="mb-3">
          <label for="registerPassword" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="registerPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-success align-self-end me-1 mb-3" name="register">Зарегистрироваться</button>
      </form>
    </div>
  </div>
</div>
</div>
    <script src="./JS/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>