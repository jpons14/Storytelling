<?php
require_once 'classes/Files.php';
require_once 'classes/Story.php';
require_once 'Exceptions/FileException.php';

//Files::checkIfExists('stories/', 'file1.json');
//die();
//
//$file = new Files('story1.json');
//try {
//    $file->add( [ 'userId' => 2, 'text' => 'el mata coches' ] );
//    echo $file;
//} catch (FileException $exception){
//    $exception->showException();
//}
header('Location: /loginForm.php');
//$file = new FIles('stories/story1.json');
//$file->add(['userId' => '1', 'text' => 'Text number 3']);
//echo $file;

//require_once 'classes/DB.php';
//require_once 'classes/StoriesDB.php';
//require_once 'Exceptions/DBException.php';
//require_once 'Exceptions/UserException.php';
//
//$stories = new StoriesDB();
//echo '<pre>$stories->all()' . print_r( $stories->all(), true ) . '</pre>';