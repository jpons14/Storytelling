<?php
require_once 'classes/DB.php';
require_once 'classes/StoriesDB.php';
require_once 'classes/User.php';
require_once 'Exceptions/DBException.php';
require_once 'Exceptions/UserException.php';

include_once 'repetitive/checkLogin.php';

$user = new User($_SESSION['userEmail']);
//require_once 'Story.php';
if (isset($_GET['logout']) && $_GET['logout'] == 'true')
    User::logout();
if (isset($_GET['unregister']) && $_GET['unregister'] == 'true') {
    $user->unregister();
}
?>
    <a href="?logout=true<?php echo $user->getUserId(); ?>">LogOut</a><br />
    <a href="?unregister=true&id=">unregister</a>
    <br />
    <br />
    <br />
<?php
$stories = new StoriesDB();
foreach ( $stories->all() as $item ) {
    print <<<HTML
    <a href="story.php?name=$item[1]">$item[1] -- $item[2]</a> -- Likes:  <a href="#?like=$item[0]">$item[3]</a><hr /> 

HTML;

}