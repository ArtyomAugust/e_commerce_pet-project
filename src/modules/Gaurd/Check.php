<?php

namespace Modules\Gaurd;

class Check
{
    public static function checkStrictText(string $inputText): string
    {
        $inputText = str_replace(" ", "", $inputText);
        $inputText = htmlentities($inputText); //replace html tags
        $inputText = stripslashes($inputText); //Un-quotes a quoted string. 
        return $inputText;
    }

    public static function checkText(string $inputText): string
    {
        $inputText = htmlentities($inputText); //replace html tags
        $inputText = stripslashes($inputText); //Un-quotes a quoted string. 
        return $inputText;
    }

    static function password_encrypt(string $password): string
    {
        $password = strip_tags($password);
        return $password = password_hash($password, PASSWORD_DEFAULT);
    }
    static function password_verify(string $password, string $hash): string
    {
        $password = strip_tags($password);
        return password_verify($password, $hash);
    }
}