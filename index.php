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
                    <div class="formTitle">Ваше ФИО</div>
                    <input class="inputField" type="text" name="user_name" placeholder="Фамилия Имя Отчество" value="<?= autoComplete($name) ?>" required>
                    <?php
                    if ($validName) {
                        echo '<p class="message ' . color($validName) . '">' . $validName . '</p>';
                    } 
                    ?>
                    <div class="formTitle">Ваш email</div>
                    <input class="inputField" type="email" name="user_email" placeholder="user@email.com" value="<?= autoCompleteVar($_SESSION['validation'], $email, $_SESSION['email']) ?>" required>
                    <?php
                    if ($validEmail) {
                        echo '<p class="message ' . color($validEmail) . '">' . $validEmail . '</p>';
                    }
                    ?>
                    <div class="formTitle">Ваш № телефона</div>
                    <input class="inputField" type="text" name="user_phone" placeholder="89123456789" value="<?= autoCompleteVar($_SESSION['validation'], $phone, $_SESSION['phone']) ?>" required>
                    <?php
                    if ($validPhone) {
                        echo '<p class="message ' . color($validPhone) . '">' . $validPhone . '</p>';
                    }
                    ?>
                    <div  class="formTitle">Сообщение</div>
                    <textarea name="message"><?= autoCompleteVar($_SESSION['validation'], $text, $_SESSION['text']) ?></textarea>
                    <div>
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
