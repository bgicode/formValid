<?php
include_once('formHandler.php');
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        </head>
    <body class="bodyFeed">
        <div class="wrap">
            <div class="formWraper">
                <form class="form" name="feedback" method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">
                    <div class="formTitle">Ваш IP</div>
                    <input class="inputField" type="text" name="user_ip" value="<?= autoCompleteIP(autoComplete($_SESSION['validation'], $ip, $_SESSION['ip'])) ?>" required>
                    <?php
                    if ($ip
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($ip, $validIP, 'неверный ввод или IP в диапазоне (10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16)');
                    }
                    ?>

                    <div class="formTitle">ID обращения</div>
                    <input class="inputField" type="number" name="contacting_id" placeholder="от 1 до 1000" value="<?= autoComplete($_SESSION['validation'], $id, $_SESSION['id']) ?>" required>
                    <?php
                    if ($id
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($id, $validID, 'ID не должен быть больше 1000');
                    }
                    ?>

                    <div class="formTitle">ваша дата рождения</div>
                    <input class="inputField" type="date" name="date" placeholder="от 10 до 90 лет" value="<?= autoComplete($_SESSION['validation'], $date, $_SESSION['date']) ?>" required>
                    <?php
                    if ($dateTime
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($date, $validDate, dateErrorMessage((int)$dateTime, (int)$timeErrOld));
                    }
                    ?>

                    <div class="formTitle">Ваше ФИО</div>
                    <input class="inputField" type="text" name="user_name" placeholder="Фамилия Имя Отчество" value="<?= autoComplete($_SESSION['validation'], $name, $_SESSION['name']) ?>" required>
                    <?php
                    if ($name
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($name, $validName);
                    }
                    ?>

                    <div class="formTitle">Ваш email</div>
                    <input class="inputField" type="email" name="user_email" placeholder="user@email.com" value="<?= autoComplete($_SESSION['validation'], $email, $_SESSION['email']) ?>" required>
                    <?php
                    if ($name
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($email, $validEmail);
                    }
                    ?>

                    <div class="formTitle">Ваш № телефона</div>
                    <input class="inputField" type="text" name="user_phone" placeholder="+79123456789" value="<?= autoComplete($_SESSION['validation'], $phone, $_SESSION['phone']) ?>" required>
                    <?php
                    if ($phone
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($phone, $validPhone);
                        echo getFilteredData($validPhone, $phone, $_SESSION['phone'], 'phoneFilter');
                    }
                    ?>

                    <div class="formTitle">Сообщение</div>
                    <textarea name="message" placeholder="не воодить ссылки, все тэги будут преобразованны" required><?= autoComplete($_SESSION['validation'], $text, $_SESSION['text']) ?></textarea>
                    <?php
                    if ($text
                        || $_SESSION['validation']
                    ) {
                        echo validMessage($text, $validText, 'текст не должен содержать ссылки');
                        echo getFilteredData($validText, $text, $_SESSION['text'], 'textFilter');
                    }
                    ?>

                    <div class="btnWrap">
                        <input class="submitBtn" type="submit" name="submit_btn" value="Отправить">
                        <input class="submitBtn" type="submit" name="exit_btn" value="Обновить">
                    </div>
                    <?php
                    if ($_SESSION['message']
                        && $_SESSION['validation']
                    ) {
                        echo '<p class="endMessage">' . $_SESSION['message'] . '</p>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>
