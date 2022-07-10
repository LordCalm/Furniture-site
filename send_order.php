<?php
include_once "connect_db.php";

$result = ['result' => 'success', 'error' => []];

$name = '';
$surname = '';
$message = '';
$order = '';
$consent = '';

if (empty($_POST['name'])) {
    $result['result'] = 'error';
    $result['error']['name'] = 'Это поле не заполнено!';
} else {
    $name = $_POST['name'];
    if (!preg_match("/^[a-zа-яё\s]+$/iu", $name)) {
        $result['result'] = 'error';
        $result['error']['name'] = 'Имя содержит недопустимые символы!';
    }
}

if (empty($_POST['surname'])) {
    $result['result'] = 'error';
    $result['error']['surname'] = 'Это поле не заполнено!';
} else {
    $surname = $_POST['surname'];
    if (!preg_match("/^[a-zа-яё\s]+$/iu", $surname)) {
        $result['result'] = 'error';
        $result['error']['surname'] = 'Фамилия содержит недопустимые символы!';
    }
}

if (empty($_POST['message'])) {
    $result['result'] = 'error';
    $result['error']['message'] = 'Это поле не заполнено!';
} else {
    $message = $_POST['message'];
    if (!preg_match("/^[a-zа-яё\s]+$/iu", $message)) {
        $result['result'] = 'error';
        $result['error']['message'] = 'Обращение содержит недопустимые символы!';
    }
}

if (empty($_POST['consent'])) {
    $result['result'] = 'error';
    $result['error']['consent'] = 'Согласие на обработку персональных данных не дано!';
}

if(empty($_POST['order'])) {
    $result['result'] = 'error';
    $result['error']['checkbox'] = 'Ни один из вариантов не выбран!';
} else {
    $order = $_POST['order'];
    $N = count($order);
    for($i = 0; $i < $N; $i++)
    {
        $query = "INSERT INTO customer (Имя, Фамилия, Обращение, Ключ_заказа)
            VALUES ('$name', '$surname', '$message', '$order[$i]')";
        if ($result['result'] === 'error' || !mysqli_query($dbconnect, $query)) {
            $result['error']['submit'] = 'Ошибка отправки заказа!';
        }
    }
}

echo json_encode($result);
?>