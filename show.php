<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Заказы</title>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container-fluid p-0">
    <?php

    include_once "connect_db.php";

    $query = "SELECT customer.Имя, customer.Фамилия, customer.Обращение, заказ.Название_заказа FROM customer, заказ WHERE customer.Ключ_заказа = заказ.Ключ_заказа";
    $result = mysqli_query($dbconnect, $query);
    ?>
    <div class="container">
        <div class="row card-row">
            <?php while ($row = mysqli_fetch_array($result)): ?>
                <div class="container card">
                    <div class="order"><?php printf("$row[Название_заказа]"); ?></div>
                    <div class="message"><p><?php printf("$row[Обращение]"); ?></p></div>
                    <div class="name"><p><?php printf("$row[Имя]"); ?></p></div>  
                    <div class="surname"><p><?php printf("$row[Фамилия]"); ?></p></div> 
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
</body>
</html>