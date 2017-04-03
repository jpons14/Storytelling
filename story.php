<?php
require_once 'classes/Files.php';
require_once 'classes/Story.php';
require_once 'classes/DB.php';
require_once 'classes/User.php';
require_once 'classes/StoriesDB.php';
require_once 'Exceptions/FileException.php';

include_once 'repetitive/checkLogin.php';
include_once 'repetitive/header.php';
?>
    <a href="story.php?back=true">Go Back!</a>
<?php

if (isset($_GET['back']) && $_GET['back'] == 'true')
    header('Location: stories.php');

if ( !empty( $_GET[ 'name' ] ) ) {


    $story = new Story( $_GET[ 'name' ] );

    if($_SERVER[ 'REQUEST_METHOD' ] == 'POST'){
        $userData = $user->getUserDataByEmail($user->getEmail());
        $story->read();
        $story->add(['userId' => $userData[0][0], 'text' => $_POST['text']]);
        header("Location: story.php?name=$_GET[name]");
    }

    $storyDB = new StoriesDB();
    $storiesDB = $storyDB->getStoresByName( $_GET[ 'name' ] );
    echo "<h2>{$storiesDB[0][1]} ==> with {$storiesDB[0][3]} likes</h2>";

    $story->read();
    $contributions = $story->getContributions();

    foreach ( $contributions as $contribution ) {
        $userData = $user->getUserDataById( (int)$contribution[ 'userId' ] );
        $text = $contribution[ 'text' ];
        print <<<CODE
<p>$text</p><p> by: {$userData[0][1]}  --- {$userData[0][2]}</p>
<hr />
CODE;

    }
    ?>
    <form action="" method="post">
        <textarea name="text" id="text_newContribution" cols="30" rows="10" placeholder="Text of the contribution"></textarea><br />
        <input type="submit" value="Add this new contribution" />
    </form>

    <script src="assets/limitTextArea.js"></script>

    <?php
}