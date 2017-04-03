<?php
require_once 'classes/DB.php';
require_once 'classes/User.php';
require_once 'Exceptions/DBException.php';
require_once 'Exceptions/UserException.php';
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $passwordHashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user = new User( $_POST[ 'email' ], $_POST[ 'name' ], $passwordHashed , true );
}