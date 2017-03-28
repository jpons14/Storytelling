<?php

class UserException extends Exception
{
    public function __construct($message, $url)
    {
        session_start();
        $_SESSION['loginError'] = $message;
        header("Location: $url");
    }

}