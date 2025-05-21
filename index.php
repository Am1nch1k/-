<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connection = new PDO('mysql:dbname=moinesam;host=mysql-8.4', 'root', '');
    
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $query = $connection->prepare("INSERT INTO users (login, password, first_name, last_name, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute([$login, $password, $first_name, $last_name, $phone, $email]);
    
    header("Location: auth.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Я буду кушац - Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Я буду кушац</h1>
        <nav>
            <a href="auth.php">Вход</a>
            <a href="index.php" class="active">Регистрация</a>
            <a href="orders.php">Мои брони</a>
            <a href="order.php">Забронировать</a>
        </nav>
    </header>
    
    <form method="POST">
        <h2>Регистрация</h2>
        <input type="text" name="login" placeholder="Логин (кириллица)" pattern="[А-Яа-я]{6,}" required>
        <input type="password" name="password" placeholder="Пароль (6+ символов)" minlength="6" required>
        <input type="text" name="first_name" placeholder="Имя" required>
        <input type="text" name="last_name" placeholder="Фамилия" required>
        <input type="tel" name="phone" placeholder="Телефон (+7(XXX)-XXX-XX-XX)" pattern="\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Зарегистрироваться</button>
        <p>Уже есть аккаунт? <a href="auth.php">Войдите</a></p>
    </form>
</body>
</html>