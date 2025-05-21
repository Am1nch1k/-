<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Я буду кушац - Мои заявки</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Логотип">
        <nav>
            <a href="auth.php">Вход или Регистрация</a>
            <a href="orders.php" class="active">Мои заявки</a>
            <a href="order.php">Оставить заявку</a>
            <a href="admin.php">Администрирование</a>
        </nav>
    </header>

    <div class="main_orders">
        <h1>История заявок</h1>
        <a href="order.php" class="button">+ Создать заявку</a>
        <div class="orders">

            <?php
                try {
                    $connection = new PDO('mysql:dbname=moinesam;host=mysql-8.4', 'root', '');
                    $query = $connection->prepare("SELECT * FROM orders ORDER BY date DESC, time DESC");
                    $query->execute();
                    $orders = $query->fetchAll();

                    foreach ($orders as $elem) {
            ?>
                <div>
                    <p>Номер заявки: <span><?= $elem["id"] ?></span></p>
                    <p>Адрес: <span><?= $elem["address"] ?></span></p>
                    <p>Номер телефона: <span><?= $elem["phone"] ?></span></p>
                    <p>Email: <span><?= $elem["email"] ?></span></p>
                    <p>Дата и время: <span><?= $elem["date"] . " " . $elem["time"] ?></span></p>
                    <p>Тип услуги: <span><?= $elem["service_type"] ?></span></p>
                    <p>Тип оплаты: <span><?= $elem["payment_type"] ?></span></p>
                    <p>Статус: 
                        <span style="
                            color: <?= 
                                $elem["status"] == 'Подтверждено' ? 'green' : 
                                ($elem["status"] == 'Отменено' ? 'red' : 'gray') 
                            ?>;
                        ">
                            <?= $elem["status"] ?>
                        </span>
                    </p>
                    <?php if ($elem["status"] == "Подтверждено"): ?>
                        <form action="review.php" method="POST">
                            <input type="hidden" name="order_id" value="<?= $elem["id"] ?>">
                            <button type="submit" class="review-btn">Оставить отзыв</button>
                        </form>
                    <?php endif; ?>
                    <?php if (!empty($elem["cancel_reason"])): ?>
                        <p>Причина отмены: <span><?= htmlspecialchars($elem["cancel_reason"]) ?></span></p>
                    <?php endif; ?>
                </div>
            <?php
                    }
                } catch (PDOException $e) {
                    echo "<p>Ошибка подключения к базе данных: " . $e->getMessage() . "</p>";
                }
            ?>

        </div>
    </div>
</body>
</html>
