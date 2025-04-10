<?php
session_start();
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $status = "Пользователь";  // Вы можете добавить разные роли, если нужно.

    // Вставляем нового пользователя в базу данных
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, user_status) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $password);
    $stmt->bindParam(4, $status);

    if ($stmt->execute()) {
        // После успешной регистрации автоматически авторизуем пользователя
        $_SESSION['user_id'] = $pdo->lastInsertId(); // Получаем ID нового пользователя
        $_SESSION['user_name'] = $name;
        $_SESSION['user_status'] = $status;

        // Перенаправляем на главную страницу или личный кабинет
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Ошибка при регистрации.";
    }
}
?>

<!-- HTML форма для регистрации -->
