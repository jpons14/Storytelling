<?php

class DBException extends Exception
{
    public function __construct($message)
    {
        echo '<div style="background-color: #ff3833; border: black 2px solid; font-size: 2em"> ' . $message . '</div>';
    }

}