<?php

function validation(string $regEx, string $field): string
{
    $options = [
        'options' => [
            'regexp' => $regEx
        ]
    ];
    if (filter_var($field, FILTER_VALIDATE_REGEXP, $options)) {
        $message = 'проверка пройдена';
    } else {
        $message = 'неверно введено';
    }

    return $message;
}

function validationEmail(string $field): string
{

    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $message = 'проверка пройдена';
    } else {
        $message = 'неверно введено';
    }

    return $message;
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

function color($param) {
    if ($param = 'проверка пройдена') {
        return 'green';
    } else {
        return 'red';
    }
}
