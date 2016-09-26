<?php

/**
 * Helper
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, altrc
 */
namespace App\Helpers;

class Helper {

    public static function jsonError($message) {
        return [
            'status' => 'error',
            'message' => $message
        ];
    }

    public static function isEmptyValuesArray($value) {
        return (empty(array_filter($value))) ? true : false;
    }
}