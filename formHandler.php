<?php
declare(strict_types = 1);

session_start();

include_once('functions.php');

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';

if ($_POST['submit_btn']) {
    $name = trim($_POST['user_name']);
    $email = trim($_POST['user_email']);
    $phone = trim($_POST['user_phone']);
    $ip = trim($_POST['user_ip']);
    $text = trim(($_POST['message']));
    $id = abs((int)$_POST['contacting_id']);
    $date = $_POST['date'];

    $dateTime = strtotime($date);
    $timeErrOld = strtotime('-90 year');
    $timeErrYoung = strtotime('-10 year');

    $regExName = '/^[А-Яа-я][а-я]{2,}((\s)[А-Яа-я][а-я]{2,}){0,2}$/u';
    $regExEmail = '/[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,}/i';
    $regExPhone ='/^(\+7)(\s*[0-9]\s*){10}$/';

    $filteredText = textFilter($text);
    $filteredPhone = phoneFilter($phone);

    $validDate = validationRange($dateTime, $timeErrOld, $timeErrYoung);
    $validID = validationRange($id, 1, 1000);
    $validName = validation($regExName, $name);
    $validEmail = validationEmail($email);
    $validPhone = validation($regExPhone, $phone);
    $validText = validationText($filteredText);
    $validIP = validationIP($ip);

    $_SESSION['validation'] = $validName && $validEmail && $validPhone && $validText && $validIP && $validID && $validDate;

    if ($_SESSION['validation']) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['date'] = $date;
        $_SESSION['text'] = $text;
        $_SESSION['ip'] = $ip;
        $_SESSION['id'] = $id;
        $_SESSION['message'] = 'Сообщение отправлено';

        header("Location: http://$host$uri/$extra");

        exit;
    }
}

if ($_POST['exit_btn']) {
    $_SESSION = [];

    unset($_COOKIE[session_name()]);

    session_destroy();

    header("Location: http://$host$uri/$extra");

    exit;
}
