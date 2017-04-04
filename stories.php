<?php
require_once 'classes/DB.php';
require_once 'classes/StoriesDB.php';
require_once 'classes/User.php';
require_once 'Exceptions/DBException.php';
require_once 'Exceptions/UserException.php';

include_once 'repetitive/checkLogin.php';
include_once 'repetitive/header.php';

$stories = new StoriesDB();
if (isset($_GET['like'])){
    $stories->likeIt($_GET['like']);
}
foreach ( $stories->all() as $item ) {
    print <<<HTML
    <a href="story.php?name=$item[1]">$item[1] -- $item[2]</a> -- Likes: $item[3]  <a href="?like=$item[0]">Like</a><hr /> 

HTML;

}

?>
<a href="newStory.php">New Story</a>
