<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Я буду кушац - Админ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Логотип">
        <nav>
            <a href="auth.php">Вход или Регистрация</a>
            <a href="orders.php">Мои заявки</a>
            <a href="order.php">Оставить заявку</a>
            <a href="admin.php">Администрирование</a>
        </nav>
    </header>
    
    <div class="main_orders">
        <h1>Управление заявками</h1>
        <div class="orders">

            <?php
                // Подключение к базе
                $connection = new PDO('mysql:dbname=moinesam;host=mysql-8.4', 'root', '');
                
                // Получение всех заказов
                $query = $connection->prepare("SELECT * FROM orders");
                $query->execute();
                $orders = $query->fetchAll();

                // Обработка формы (если отправлена)
                if (isset($_POST["status"]) && isset($_POST["cancel_reason"]) && isset($_POST["order_id"])) {
                    $status = $_POST["status"];
                    $cancel_reason = $_POST["cancel_reason"];
                    $order_id = $_POST["order_id"];

                    $update = $connection->prepare("UPDATE orders SET status = ?, cancel_reason = ? WHERE id = ?");
                    $update->execute([$status, $cancel_reason, $order_id]);
                }

                // Вывод заказов
                foreach ($orders as $order) {
            ?>

            <div>
                <p>Номер заявки: <span><?= $order["id"] ?></span></p>
                <p>Адрес: <span><?= $order["address"] ?></span></p>
                <p>Номер телефона: <span><?= $order["phone"] ?></span></p>
                <p>Email: <span><?= $order["email"] ?></span></p>
                <p>Дата и время: <span><?= $order["date"] . " " . $order["time"] ?></span></p>
                <p>Тип услуги: <span><?= $order["service_type"] ?></span></p>
                <p>Тип оплаты: <span><?= $order["payment_type"] ?></span></p>
                
                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $order["id"] ?>">
                    
                    <p>Статус</p>
                    <select name="status">
                        <option value="Новое" <?= $order["status"] == "Новое" ? "selected" : "" ?>>Новое</option>
                        <option value="В работе" <?= $order["status"] == "В работе" ? "selected" : "" ?>>В работе</option>
                        <option value="Выполнено" <?= $order["status"] == "Выполнено" ? "selected" : "" ?>>Выполнено</option>
                        <option value="Отменено" <?= $order["status"] == "Отменено" ? "selected" : "" ?>>Отменено</option>
                    </select>

                    <p>Причина отмены</p>
                    <textarea name="cancel_reason" placeholder="Причина отмены"><?= htmlspecialchars($order["cancel_reason"]) ?></textarea>
                    
                    <input type="submit" value="Сохранить">
                </form>
            </div>

            <?php } ?>

        </div>
    </div>
</body>
</html>
