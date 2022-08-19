<?php

/**
 * Функция распечатывает массив или объект в читаемом виде
 * @param $data
 * @return void
 */
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

