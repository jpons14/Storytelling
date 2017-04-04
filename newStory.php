<?php
require_once 'classes/DB.php';
require_once 'classes/StoriesDB.php';
require_once 'classes/User.php';
require_once 'classes/Files.php';
require_once 'classes/Story.php';

include_once 'repetitive/checkLogin.php';
include_once 'repetitive/header.php';
?>
<a href="story.php?back=true">Go Back!</a>
<?php

if (isset($_GET['back']) && $_GET['back'] == 'true')
    header('Location: stories.php');


if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $story = new Story( $_POST[ 'name' ],
        [ 'userId' => $user->getUserDataByEmail($user->getEmail())[0][0], 'name' => $_POST['name'], 'text' => $_POST[ 'text' ], 'subject' => $_POST[ 'subject' ] ] );
}

?>
<form action="" method="post">
    <input type="text" name="name" placeholder="Name"/><br/>
    <input type="text" name="subject" placeholder="Subject"/><br/>
    <textarea name="text" id="" cols="30" rows="10" placeholder="Text"></textarea><br/>
    <input type="submit" value="New Story"/>
</form>


<script src="assets/limitTextArea.js"></script>