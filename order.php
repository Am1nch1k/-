<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Я буду кушац - Бронирование</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Я буду кушац</h1>
        <nav>
            <a href="auth.html">Вход</a>
            <a href="index.html">Регистрация</a>
            <a href="orders.html">Мои брони</a>
            <a href="order.html" class="active">Забронировать</a>
        </nav>
    </header>
    
    <form>
        <h2>Бронирование столика</h2>
        <input type="date" required>
        <input type="time" required>
        <select required>
            <option value="" disabled selected>Количество гостей</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
        <input type="tel" placeholder="Контактный телефон" required>
        <button type="submit">Забронировать</button>
    </form>
</body>
</html>