<?php

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
        if(filter_var($field, FILTER_VALIDATE_INT, $options)) {
            return true;
        } else {
            return false;
        }
}

// function validationAllRes(string $value1, string $value2, string $value3): bool
// {
//     if (empty($value1) && empty($value2) && empty($value3)) {
//         return true;
//     } else {
//         return false;
//     }
// }

// function autoComplete(mixed $field): string
// {
//     if ($field) {
//         return $field;
//     } else {
//         return '';
//     }
// }

// function autoCompleteVar(mixed $param = '', mixed $error = '', mixed $success = ''): string
// {
//     if (!$param) {
//         return autoComplete($error);
//     } elseif ($param) {
//         return autoComplete($success);
//     } else {
//         return '';
//     }
// }

function autoComplete(mixed $param = '', mixed $error = '', mixed $success = ''): string
{
    if (!$param) {
        if ($error) {
            return $error;
        } else {
            return '';
        }
    } elseif ($param) {
        if ($success) {
            return $success;
        } else {
            return '';
        }
    } else {
        return '';
    }
}


function validMessage(mixed $field, mixed $check): string
{
    if ($check) {
        $color = 'green';
        $message = 'проверка пройдена';
    } else {
        $color = 'red';
        $message = 'неверно введено';
    }

    if ($field) {
        return '<p class="message ' . $color . '">' . $message . '</p>';
    } elseif ($_SESSION['validation']) {
        return '<p class="message green">проверка пройдена</p>';
    }
}

function textFilter(string $field): string
{
    return filter_var($field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function phoneFilter(string $field): string
{
    return str_replace(' ', '', $field);
}

function autoCompleteIP(string $ipaddres): string
{
    if (!$ipaddres) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
    } else {
        return $ipaddres;
    }
}

// function getFilteredData($field, $successField, $calbeck) {
//     if (!$successField
//         && $field
//     ) {
//         return $calbeck($field);
//     } elseif ($successField) {
//         return $calbeck($successField);
//     }
// }

function getFilteredData($check, $field, $successField, $filter)
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
}

