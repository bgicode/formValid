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

function validationEmail(string $field): bool
{
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
       return false;
    }
}

function validationAllRes(string $value1, string $value2, string $value3): bool
{
    if (empty($value1) && empty($value2) && empty($value3)) {
        return true;
    } else {
        return false;
    }
}

function autoComplete(mixed $field): string
{
    if ($field) {
        return $field;
    } else {
        return '';
    }
}

function autoCompleteVar(mixed $param, mixed $error = '', mixed $success = ''): string
{
    if (!$param) {
        return autoComplete($error);
    } elseif ($param) {
        return autoComplete($success);
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
