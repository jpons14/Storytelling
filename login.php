<?php
require_once 'classes/DB.php';
require_once 'classes/User.php';
require_once 'Exceptions/DBException.php';
require_once 'Exceptions/UserException.php';
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $user = new User( 'name', $_POST[ 'email' ], sha1( $_POST[ 'password' ] ) );
}
