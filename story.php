<?php
require_once 'classes/Files.php';
require_once 'classes/Story.php';
require_once 'Exceptions/FileException.php';

include_once 'repetitive/checkLogin.php';

if (!empty($_GET['name'])){
    $story = new Story($_GET['name']);
    $story->read();
    echo '<pre>$story' . print_r( $story->__toString(), true ) . '</pre>';
}