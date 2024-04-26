<?php
function dateErrorMessage(int $dateTime, int $timeOld): string
{
    if ($dateTime < $timeOld) {
        return 'возраст превышает допустимое значение';
    } else {
        return 'возраст меньше допустимого значения';
    }
}

function validation(string $regEx, string $field): bool
{
    $options = [
        'options' => [
            'regexp' => $regEx
        ]
    ];
    if (filter_var($field, FILTER_VALIDATE_REGEXP, $options)) {
        return true;
    } else {
        return false;
    }
}

function validationIP(string $field)
{
    if (filter_var($field, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
        return true;
    } else {
        return false;
    }
}

function validationEmail(string $field): bool
{
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validationText(string $field): bool
{
    $check = true;
    foreach (explode(' ', $field) as $char) {
        if (filter_var($char, FILTER_VALIDATE_URL)) {
            $check = false;
            break;
        } else {
            $check = true;
        }
    }
    return $check;
}

function validationRange(int $field, int $min, int $max): bool
{
    $options = [
        'options' => [
            'min_range' => $min,
            'max_range' => $max,
        ]
    ];

    if (filter_var($field, FILTER_VALIDATE_INT, $options)) {
        return true;
    } else {
        return false;
    }
}

function autoComplete(mixed $param = '', mixed $error = '', mixed $success = ''): string
{
    if (!$param) {
        if ($error) {
            return $error;
        }
    } elseif ($param) {
        if ($success) {
            return $success;
        }
    }

    return '';

}

function validMessage(mixed $field, mixed $check, string $errMessage = 'неверно введено'): string
{
    if ($check) {
        $color = 'green';
        $message = 'проверка пройдена';
    } else {
        $color = 'red';
        $message = $errMessage;
    }

    if ($field) {
        return '<p class="message ' . $color . '">' . $message . '</p>';
    } elseif ($_SESSION['validation']) {
        return '<p class="message green">проверка пройдена</p>';
    }
}

function textFilter(string $field): string
{
    return strip_tags($field);
}

function phoneFilter(string $field): string
{
    return preg_replace('/\+7|\s/', '', $field);
}

function autoCompleteIP(string $ipAddres): string
{
    if (!$ipAddres) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
    } else {
        return $ipAddres;
    }
}

function getFilteredData(mixed $check, mixed $field, mixed $successField, callable $filter): string
{
    if (!$successField
        && $field
    ) {
        $filteredData =  $filter($field);
    } elseif ($successField) {
        $filteredData = $filter($successField);
    }
    
    if ($check
        || $_SESSION['validation']
    ) {
        return '<div class="afterFilterWrap"><span class="afterFilterTitle">после фильтрации: </span><span class="message afterFilter">' . $filteredData . '</span></div>';
    }

    return '';
}
