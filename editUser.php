<?php

require_once 'classes/DB.php';
require_once 'classes/StoriesDB.php';
require_once 'classes/User.php';
require_once 'Exceptions/DBException.php';
require_once 'Exceptions/UserException.php';

include_once 'repetitive/checkLogin.php';
include_once 'repetitive/header.php';
?>
    <a href="story.php?back=true">Go Back!</a>
<?php

if ( isset( $_GET[ 'back' ] ) && $_GET[ 'back' ] == 'true' )
    header( 'Location: stories.php' );

$userData = $user->getUserDataByEmail();

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $user->update(['name' => $_POST['name']], $userData[0][0]);
    header('Location: editUser.php');
}

?>
<form action="" method="POST">
    <input type="text" placeholder="Name" name="name"  value="<?php echo $userData[0][1]; ?>"/>
    <input type="submit" value="Update user!" />
</form>
